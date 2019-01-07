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
        $id = (is_null($id)) ? Auth::user()->id : $id;
        return Order::with([
                    'statuses',
                    'items'
                ])->find($id);
    }    
    
    
    /**
     * Display the specified resource.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function showByUser() {
        return Order::with(['statuses','items'])->where('user_id', Auth::user()->id)->get();
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
                throw new \Exception("Order already paid!");
            }

            $levelcontroller = new LevelController();
            $productController = new ProductController();
            
            foreach ($order->items as $item) {

                $product = $productController->show($item->product_id);

                if ($product->productType->is_active === 1) {
                    switch ($product->productType->name) {
                        case "Activation":
                            $this->payActivation($order);
                            $this->payUnilevel($order, $item);
                            $this->payBinary($order, $item);
                            break;

                        case "Multilevel":
                            $this->payUnilevel($order, $item);
                            $this->payBinary($order, $item);
                            break;

                        case "Voucher":
                            $this->payVoucher($order);
                            break;
                    }
                }
            }

//            $updated = $this->updateStatus($order, OrderStatusEnum::PAID);

            DB::commit();
//            return response($updated, 200);
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
                'payday' => ($status === OrderStatusEnum::PAID) ? Carbon::now() : null
            ]);

            OrderStatusController::store($order);

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
    protected function payActivation($order) {
        try {
            $GenealogyController = new GenealogyController();
            $SysBusinessController = SysBusinessController::show();

            $Genealogy = $GenealogyController->updateStatus($order->user_id, UserStatusEnum::ACTIVE);

            if ($SysBusinessController->binary === 1) {
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
            $levelController = new LevelController();
            $levels = $levelController->show($item->product_id);

            $indicators = GenealogyController::indicatorsAsc($order->salesman);
            if (count($indicators) > 0) {
                foreach ($indicators as $indicator) {
                    $level = LevelController::betweenNormalize($levels, (int) $indicator->level);
                    if ($level) {
                        return BonusController::unilevel($level, $indicator, $item);
                    }
                }
            }
   
            
        } catch (\Exception $exc) {
            throw new \Exception('Multilevel ' . $exc->getMessage());
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
            $levelController = new LevelController();
            $levels = $levelController->show($item->product_id);
            
            $nodes = GenealogyController::nodesAsc($order->salesman);
            if (count($nodes) > 0) {
                foreach ($nodes as $node) {
                    $level = LevelController::betweenNormalize($levels, (int) $node->level);
                    if ($level) {
                        return BonusController::binary($level, $node, $item);
                    }
                }
            }
            
        } catch (\Exception $exc) {
            throw new \Exception('Multilevel ' . $exc->getMessage());
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
