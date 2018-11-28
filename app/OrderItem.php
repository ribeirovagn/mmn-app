<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    protected $fillable = ['order_id',  'product_id', 'quantity', 'value_unity', 'value'];
    
    public $timestamps = false;
}
