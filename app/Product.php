<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['product_type_id', 'name', 'description', 'value', 'binary', 'unilevel', 'binary_percentage'];

    
    /**
     * 
     * @return type App\ProductType
     */
    public function productType(){
        return $this->belongsTo('App\ProductType');
    }
    
    public function levels(){
        return $this->hasMany('App\Level')->with('bonus');
    }
}
