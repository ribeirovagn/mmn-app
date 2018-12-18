<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = ['user_id', 'value_fiat', 'value_crypto', 'status', 'payday', 'txid', 'salesman'];
    
    public function statuses(){
        return $this->hasMany('App\OrderStatus');
    }
    
    public function items(){
        return $this->hasMany('App\OrderItem');
    }
    
    public function levels(){
        return $this->hasManyThrough('App\Level', 'App\OrderItem', 'product_id', 'product_id', 'id', 'products_id');
    }
    
}
