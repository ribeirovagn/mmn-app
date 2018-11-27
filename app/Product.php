<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['product_type_id', 'name', 'description', 'value', 'binary', 'unilevel'];

    protected $hidden = ['product_type_id'];
    
    /**
     * 
     * @return type App\ProductType
     */
    public function productType(){
        return $this->belongsTo('App\ProductType');
    }
}
