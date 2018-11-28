<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = ['user_id', 'value_fiat', 'value_crypto', 'status', 'payday'];
    
    public function status(){
        return $this->hasMany('App\OrderStatus');
    }
    
    public function items(){
        return $this->hasMany('App\OrderItem');
    }
    
}
