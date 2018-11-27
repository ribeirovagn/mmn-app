<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductType extends Model
{
    protected $fillable = ['name', 'is_active'];


    public function product(){
        return $this->hasMany('App\Product');
    }
    
}
