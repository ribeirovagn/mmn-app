<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GraduationsHist extends Model
{
    protected $fillable = ['graduation_id', 'user_id'];
    
    
    public function graduation(){
        return $this->belongsTo('App\Graduation');
    }
    
}
