<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GenealogyResume extends Model
{
    protected $fillable = [
        'user_id',
        'indicated',
        'product_plan_id',
        'binary_percentage',
        'dots_binary_0',
        'dots_binary_1',
        'dots_unilevel',
        'quantity_0',
        'quantity_1'
    ];
    
    public $timestamps = false;
    
    protected $primaryKey = 'user_id';
    
    
    public function user(){
        return $this->belongsTo('App\User', 'user_id');
    }
    
    public function genealogy(){
        return $this->belongsTo('App\Genealogy', 'user_id', 'user_id');
    }
}
