<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model {

    protected $fillable = [
        'user_id',
        'value_fiat',
        'value_crypto',
        'status',
        'payday',
        'txid',
        'salesman',
        'payment_type'
    ];

    public function statuses() {
        return $this->hasMany('App\OrderStatus')->with('status');
    }
    
    public function status(){
        return $this->belongsTo('App\SysOrderStatus', 'status');
    }

    public function items() {
        return $this->hasMany('App\OrderItem')->with('product');
    }

    public function levels() {
        return $this->hasManyThrough('App\Level', 'App\OrderItem', 'product_id', 'product_id', 'id', 'products_id');
    }
    
    public function user(){
        return $this->belongsTo('App\User', 'user_id');
    }

}
