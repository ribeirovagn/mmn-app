<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BinaryClosure extends Model
{
    protected $fillable = ['note'];
   
    protected $hidden = [
        'updated_at'
    ];


    public function closure(){
        return $this->hasMany('App\Closure')->with('user');
    }
}
