<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderStatus extends Model
{
    protected $fillable = ['order_id', 'user_id', 'status', 'note'];
    
    protected $hidden = ['id', 'order_id', 'updated_at', 'user_id'];
    
    
    
    public function status(){
        return $this->hasOne('App\SysOrderStatus','id', 'status');
    }
}
