<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Genealogy extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'side', 'indicator', 'father', 'child_0', 'child_1', 'binary', 'preferencial_side', 'date_positioning', 'status'
    ];
    
    public function user(){
        return $this->belongsTo('App\User');
    }
    
    public function genealogies_status(){
        return $this->hasMany('App\GenealogyStatus');
    }
}