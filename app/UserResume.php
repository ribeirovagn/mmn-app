<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserResume extends Model {

    protected $fillable = [
        'user_id',
        'amount',
        'debit',
        'amount_lidership',
        'debit_lidership',
        'bonus_limits',
        'amount_bonus'
    ];
    
    public $timestamps = false;
    
    /**
     * 
     * @return App\Users
     */
    public function user(){
        return $this->belongsTo('App\Users');
    }

}
