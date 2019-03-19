<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Closure extends Model
{
    protected $fillable = [
        'binary_closure_id',
        'user_id',
        'dots_binary_0',
        'dots_binary_1',
        'dots_unilevel',
        'graduation_id',
        'status',
        'binary_percentage',
        'less_leg'
    ];
    
    protected $hidden = [
        'binary_closure_id',
        'created_at',
        'updated_at',
        'user_id'
    ];



    /**
     * 
     * @return type
     */
    public function user(){
        return $this->hasOne('App\User', 'id', 'user_id');
    }
    
    /**
     * 
     * @return type
     */
    public function binary_closure(){
        return $this->belongsTo('App\BinaryClosure');
    }
    
    public function graduation(){
        return $this->belongsTo('App\Graduation', 'graduation_id');
    }
    
    public function statuses(){
        return $this->hasOne('App\SysUserStatus', 'id', 'status');
    }
}
