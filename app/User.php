<?php

namespace App;

use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\DB;

class User extends Authenticatable {

    use HasApiTokens,
        Notifiable;


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'username'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

        
    /**
     * 
     * @return App\Genealogy
     */
    public function genealogies() {
        return $this->hasOne('App\Genealogy');
    }

    /**
     * 
     * @return App\GenealogyResume
     */
    public function genealogy_resume() {
        return $this->hasOne('App\GenealogyResume');
    }

    /**
     * 
     * @return App\GenealogyStatus
     */
    public function genealogy_statuses() {
        return $this->hasMany('App\GenealogyStatus');
    }
    
    public function graduations(){
        return $this->hasMany('App\GraduationsHist')
                ->join('graduations', 'graduations.id', 'graduations_hists.graduation_id')
                ->orderBy('ordinal', 'desc');
    }

}
