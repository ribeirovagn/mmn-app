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
        return $this->hasOne('App\Genealogy')
                ->join('sys_user_statuses', 'sys_user_statuses.id', 'genealogies.status')
                ->select('sys_user_statuses.name', 'genealogies.*')
                ->with('sponsor');
    }
    
    /**
     * 
     * @return type
     */
    public function indicator(){
        return $this->hasOne('App\User');
    }

    /**
     * 
     * @return App\GenealogyResume
     */
    public function genealogy_resume() {
        return $this->hasOne('App\GenealogyResume')
                ->join('graduations', 'graduations.id', 'graduations_id', 'indicated')
                ->select('graduations.name', 'genealogy_resumes.*');
    }

    /**
     * 
     * @return App\GenealogyStatus
     */
    public function genealogy_statuses() {
        return $this->hasMany('App\GenealogyStatus')
                ->join('sys_user_statuses', 'sys_user_statuses.id', 'genealogy_statuses.status');
    }
    
    public function graduations(){
        return $this->hasMany('App\GraduationsHist')
                ->with('graduation');
    }

}
