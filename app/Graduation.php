<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Graduation extends Model
{
    protected $fillable = [
        'name',
        'figure',
        'ordinal',
        'limit',
        'dots_start',
        'dots_end',
        'value'
    ];
    
    public function levels(){
        return $this->hasMany('App\GraduationsLevels')->with(['dependence']);
    }
}
