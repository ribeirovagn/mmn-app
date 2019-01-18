<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GraduationsLevels extends Model
{
    protected $fillable = ['graduation_id', 'graduation_level', 'quantity'];
    
    
    public function graduation(){
        return $this->belongsTo('App\Graduation');
    }
    
    public function dependence(){
        return $this->belongsTo('App\Graduation', 'graduation_level');
    }
    
}
