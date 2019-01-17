<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SysBusiness extends Model
{
    protected $fillable = ['binary', 'unilevel', 'leadership_balance', 'withdraw_is_active', 'withdraw_tax', 'sys_binary_type_id'];
    
    protected $hidden = ['created_at', 'updated_at', 'id'];
    
    public function binarytype(){
        return $this->hasOne('App\SysBinaryType', 'id', 'sys_binary_type_id');
    }
}
