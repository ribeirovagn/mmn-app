<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Genealogy extends Model {

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'side',
        'indicator',
        'father',
        'child_0',
        'child_1',
        'binary',
        'preferencial_side',
        'date_positioning',
        'status'
    ];
    protected $primaryKey = 'user_id';

    public function user() {
        return $this->belongsTo('App\User');
    }
    
    public function sponsor(){
        return $this->hasOne('App\User', 'id', 'indicator');
    }

    /**
     * 
     * @return type
     */
    public function genealogies_status() {
        return $this->hasMany('App\GenealogyStatus');
    }

    /**
     * 
     * @return type
     */
    public function leaf0() {
        return $this->hasOne('App\Genealogy', 'user_id', 'child_0')->with('user');
    }

    /**
     * 
     * @return mixed
     */
    public function leaf1() {
        return $this->hasOne('App\Genealogy', 'user_id', 'child_1')->with('user');
    }
    
    public function father(){
        return $this->hasOne('App\Genealogy', 'user_id', 'father')->with(['user']);
    }
    
    public function indicator(){
        return $this->hasOne('App\Genealogy', 'user_id', 'indicator')->with(['user']);
    }

    public function children() {
        return $this->hasMany('App\Genealogy', 'indicator')->with(['user', 'status', 'resume']);
    }
    
    public function resume(){
        return $this->hasOne('App\GenealogyResume', 'user_id', 'user_id')->with('graduation');
    }
    
    public function status(){
        return $this->hasOne('App\SysUserStatus', 'id', 'status');
    }

    /**
     * 
     * @param type $side
     * @param type $indicator
     * @return type
     */
    public static function lastNode($side, $indicator) {

        $query = "SELECT 
                    child, parent, lvl AS level, status
                FROM
                    (SELECT 
                        @r AS parent, status, 
                            (SELECT 
                                    @r:=child_{$side}
                                FROM
                                    genealogies
                                WHERE
                                    user_id = parent
                                LIMIT 1) AS child,
                            @l:=@l + 1 AS lvl
                    FROM
                        (SELECT @r:= {$indicator}, @l:=0, @cl:=0) vars, genealogies
                    HAVING parent IS NOT NULL) AS h
                WHERE
                    child IS NOT NULL";

//        return $query;
        return DB::select(DB::raw($query));
    }

    /**
     * 
     * @param type $node
     * @return type
     */
    public static function indicatorsAsc($node) {
        $query = "SELECT 
                    child, parent, lvl AS level, status
                FROM
                    (SELECT 
                        @r AS parent, status, 
                            (SELECT 
                                    @r:=indicator
                                FROM
                                    genealogies
                                WHERE
                                    user_id = parent
                                LIMIT 1) AS child,
                            @l:=@l + 1 AS lvl
                    FROM
                        (SELECT @r:= {$node}, @l:=0, @cl:=0) vars, genealogies
                    HAVING parent IS NOT NULL) AS h
                WHERE
                    child IS NOT NULL";
        return DB::select(DB::raw($query));
    }

    /**
     * 
     * @param type $node
     * @return type
     */
    public static function nodesAsc($node) {
        $query = "SELECT 
                    child, parent, lvl AS level, status, side
                FROM
                    (SELECT 
                        @r AS parent, status, side,
                            (SELECT 
                                    @r:=father
                                FROM
                                    genealogies
                                WHERE
                                    user_id = parent
                                LIMIT 1) AS child,
                            @l:=@l + 1 AS lvl
                    FROM
                        (SELECT @r:= {$node}, @l:=0, @cl:=0) vars, genealogies
                    HAVING parent IS NOT NULL) AS h
                WHERE
                    child IS NOT NULL";
        return DB::select(DB::raw($query));
    }

    
    /**
     * Search father
     * @return type
     */
    public function binaryfather(){
        return $this->hasOne('App\Genealogy', 'user_id', 'father')->with(['binaryfather', 'father', 'user']);
    }

    
    /**
     * Search indicators
     * @return type
     */
    public function unilevelindicator(){
        return $this->hasOne('App\Genealogy', 'user_id', 'indicator')->with(['unilevelindicator','indicator', 'user']);
    }

}
