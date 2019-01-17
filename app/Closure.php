<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Closure extends Model
{
    protected $fillable = [
        'binary_closure_id',
        'user_id',
        'dots_binary_0',
        'dots_binary_1',
        'dots_unilevel',
        'graduation_id',
        'status',
        'binary_percentage'
    ];
    
    
    public function user(){
        return $this->hasOne('App\User', 'id', 'user_id');
    }
}
