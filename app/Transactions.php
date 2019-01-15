<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transactions extends Model
{
    protected $fillable = ['user_id', 'references_id', 'value', 'status', 'type', 'level', 'related'];
    
    public function statuses(){
        return $this->hasMany('App\TransactionStatus', 'transaction_id')
                ->join('sys_transactions_statuses', 'sys_transactions_statuses.id', 'transaction_statuses.status')
                ->select('transaction_statuses.*', 'sys_transactions_statuses.name');
    }
    
    public function user(){
        return $this->belongsTo('App\User', 'user_id');
    }
    
    public function related(){
        return $this->hasOne('App\Transactions', 'related');
    }
}
