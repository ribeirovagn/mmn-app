<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bank extends Model
{
    protected $fillable = [
        'code',
        'country_id',
        'name',
        'url',
        'main'
    ];
    
    protected $hidden = [
        'country_id',
        'created_at',
        'updated_at',
        
    ];




    public function country(){
        return $this->belongsTo('App\Country');
    }
}
