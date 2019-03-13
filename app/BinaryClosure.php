<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BinaryClosure extends Model
{
    protected $fillable = ['note'];
   
    
    public function closure(){
        return $this->hasMany('App\Closure')->with('user');
    }
}
