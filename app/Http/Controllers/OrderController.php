<?php

namespace App\Http\Controllers;

use App\Order;
use App\OrderStatus;
use App\OrderItem;
use App\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Enum\OrderStatusEnum;
use App\Http\Enum\UserStatusEnum;
use Carbon\Carbon;

class OrderController extends Controller {

    protected $_SysBusinessController = null;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        return Order::with('statuses')->with('items')->get();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        DB::beginTransaction();
        try {

            $requestProducts = $request->all();
            $value_fiat = 0;

            $genealogyController = new GenealogyController();
            $genealogy = $genealogyController->show(Auth::user()->id);

            $order = Order::create([
                        'user_id' => Auth::user()->id,
                        'value_fiat' => $value_fiat,
                        'value_crypto' => 0,
                        'status' => 1,
                        'salesman' => $genealogy->genealogies->indicator
            ]);

            OrderStatusController::store($order);

            foreach ($requestProducts as $products) {

                $product = Product::findOrFail($products['id']);

                if ($product->is_active === 1) {

                    OrderItem::create([
                        'order_id' => $order->id,
                        'product_id' => $product->id,
                        'quantity' => $products['quantity'],
                        'value_unity' => $product->value,
                        'value' => ($product->value * $products['quantity'])
                    ]);

                    $value_fiat += ($product->value * $products['quantity']);
                } else {
                    throw new \Exception('Produto Inativo: ' . $products->name . ' - ' . $product->description);
                }
            }

            $order->update([
                'value_fiat' => $value_fiat
            ]);

            DB::commit();

            return response([
                'order' => $this->show($order->id)
                    ], 201);
        } catch (\Exception $ex) {
            DB::rollBack();
            return response([
                'error' => $ex->getMessage()
                    ], 422);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show($id = null) {
        return Order::with([
                    'statuses',
                    'status',
                    'items',
                    'user'
                ])->find($id);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function showByUser() {
        return Order::with(['statuses', 'items'])
                        ->join('sys_order_statuses', 'sys_order_statuses.id', 'orders.status')
                        ->select('sys_order_statuses.name', 'orders.*')
                        ->where('user_id', Auth::user()->id)->get();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order) {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order) {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order) {
        //
    }

    /**
     * Pagamento de pedidos
     *
     * @param int $id
     */
    public function pay($id) {
        DB::beginTransaction();
        try {
            $order = $this->show($id);

            if ($order->status === OrderStatusEnum::PAID) {
//                throw new \Exception("Order already paid!");
            }

            $userResume = \App\UserResume::find(Auth::user()->id);

            if ($order->value_fiat > $userResume->amount) {
//                throw new \Exception("Insufficient funds!");
            }


            $this->_SysBusinessController = SysBusinessController::show();
            $levelcontroller = new LevelController();
            $productController = new ProductController();

            foreach ($order->items as $item) {

                $product = $productController->showProduct($item->product_id);

                if ($product->productType->is_active === 1) {
                    switch ($product->productType->name) {
                        case "Activation":
                            $this->payActivation($order, $item);
                            $this->payUnilevel($order, $item);
                            $this->payBinary($order, $item);
                            break;

                        case "Multilevel":
                            $updated = $this->payUnilevel($order, $item);
                            $updated = $this->payBinary($order, $item);
//                            DB::rollBack();
//                            return $updated;
//                            
                            break;

                        case "Voucher":
                            $this->payVoucher($order);
                            break;
                    }
                }
            }

            $updated = $this->updateStatus($order, OrderStatusEnum::PAID);

            DB::commit();
            return response([
                'message' => 'OK',
                'updated' => $updated
                    ], 200);
        } catch (\Exception $ex) {
            DB::rollBack();
            return response([
                'error' => 'Failure: ' . $ex->getMessage()
                    ], 422);
        }
    }

    /**
     *
     * @param type $order
     * @param type $status
     * @return type
     * @throws \Exception
     */
    protected function updateStatus($order, $status) {
        try {

            $order->update([
                'status' => $status,
                'payment_type' => \App\Http\Enum\SysPaymentTypeEnum::WITHDRAW,
                'payday' => ($status === OrderStatusEnum::PAID) ? Carbon::now() : null
            ]);

            OrderStatusController::store($order);
            TransactionsController::paymentOrder($order);
            return $this->show($order->id);
        } catch (\Exception $ex) {
            throw new \Exception($ex->getMessage());
        }
    }

    /**
     *
     * @param App\Order $order
     * @throws \Exception
     */
    protected function payActivation($order, $item) {
        try {

            $GenealogyController = new GenealogyController();
            $Genealogy = $GenealogyController->updateStatus($order->user_id, UserStatusEnum::ACTIVE);
            $genealogyResumes = \App\GenealogyResume::find($order->user_id);

            $genealogyResumes->update([
                'product_plan_id' => $item->product->id,
                'binary_percentage' => $item->product->binary_percentage,
            ]);

            if ($this->_SysBusinessController->binary === 1) {
                $GenealogyController->binaryPositioning($order->user_id);
            }
        } catch (\Exception $ex) {
            throw new \Exception('Activation ' . $ex->getMessage());
        }
    }

    /**
     *
     * @param App\Order $order
     * @param type $item
     * @return type
     * @throws \Exception
     */
    protected function payUnilevel($order, $item) {
        try {

            if ((int) $this->_SysBusinessController->unilevel === 1) {

                $GenealogyController = new GenealogyController();

                $genealogy = $GenealogyController->getindicador($order->user_id);

                $levels = [];

                foreach ($genealogy as $key => $value) {

                    $bonus = LevelController::getByProductAndLevel($item->product_id, $key, \App\Http\Enum\LevelTypeEnum::UNILEVEL);

                    if (count($bonus) > 0) {
                        $levels[] = [
                            'level' => $key,
                            'node' => $genealogy[$key],
                            'levels' => $bonus,
                            'item' => $item,
                        ];
                    }
                }

                if (count($levels) > 0) {
                    $levels = collect($levels);
                    $bonus = [];
                    foreach ($levels as $level) {
                        $bonus[] = BonusController::unilevel($level);
                    }

                    return $bonus;
                }
            }
        } catch (\Exception $exc) {
            throw new \Exception('Unilevel ' . $exc->getMessage());
        }
    }

    /**
     *
     * @param App\Order $order
     * @param type $item
     * @return type
     * @throws \Exception
     */
    protected function payBinary($order, $item) {
        try {
//            return $this->_SysBusinessController;
            if ($this->_SysBusinessController->binary === 1) {
                $GenealogyController = new GenealogyController();
                $genealogy = $GenealogyController->getFather($order->user_id);
                $levels = [];
                                
                foreach ($genealogy as $key => $value) {
                    $bonus = LevelController::getByProductAndLevel($item->product_id, $key, \App\Http\Enum\LevelTypeEnum::BINARY);
                    if (count($bonus) > 0) {
                        $levels[] = [
                            'level' => $key,
                            'node' => $genealogy[$key],
                            'levels' => $bonus,
                            'item' => $item,
                        ];
                    }
                }
                
                if (count($levels) > 0) {
                    $bonus = [];
                    foreach ($levels as $level) {
                        $bonus[] = BonusController::binary($level);
                    }

                    return $bonus;
                }
            }
        } catch (\Exception $exc) {
            throw new \Exception('= Binary = ' . $exc->getMessage());
        }
    }

    /**
     *
     * @param App\Order $order
     * @throws \Exception
     */
    protected function payVoucher($order) {
        try {
            
        } catch (Exception $exc) {
            throw new \Exception('Voucher ' . $exc->getMessage());
        }
    }

}
