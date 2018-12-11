<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Level extends Model
{
    protected $fillable = [
        'start',
        'end',
        'bonus_id',
        'product_id',
        'dots_binary',
        'dots_unilevel',
        'amount',
    ];
    
    
    public function statuses(){
        return $this->hasMany("App\LevelStatus");
    }
    
    public function bonus(){
        return $this->belongsTo("App\Bonus");
    }
}
