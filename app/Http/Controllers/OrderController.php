<?php

namespace App\Http\Controllers;

use App\Order;
use App\OrderStatus;
use App\OrderItem;
use App\Product;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        return Order::with('status')->with('items')->where('user_id', '=', Auth::user()->id)->get();
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
            
            $value_fiat = 0;
            
            $order = Order::create([
                        'user_id' => Auth::user()->id,
                        'value_fiat' => $value_fiat,
                        'value_crypto' => 0,
                        'status' => 1
            ]);


            OrderStatus::create([
                'order_id' => $order->id,
                'user_id' => $order->user_id,
                'status' => $order->status
            ]);

            foreach ($request->products as $products) {

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
                'error' => $ex->getPrevious()
                    ], 422);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        return Order::with('status')->with('items')->find($id);
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

}
