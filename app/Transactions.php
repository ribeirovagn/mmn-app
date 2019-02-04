<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transactions extends Model
{
    protected $fillable = ['user_id', 'references_id', 'value', 'status', 'type', 'level', 'related', 'description', 'note', 'operation', 'bank_draft_id'];
    
   
    protected $hidden = ['user_id', 'operation', 'type', 'bank_draft_id'];


    public function statuses(){
        return $this->hasMany('App\TransactionStatus', 'transaction_id')
                ->join('sys_transactions_statuses', 'sys_transactions_statuses.id', 'transaction_statuses.status')
                ->select('transaction_statuses.*', 'sys_transactions_statuses.name');
    }
    
    public function status(){
        return $this->belongsTo("App\SysTransactionsStatus", 'status');
    }
    
    public function user(){
        return $this->belongsTo('App\User', 'user_id');
    }
    
    public function related(){
        return $this->hasOne('App\Transactions', 'related');
    }
    
    public function type(){
        return $this->hasOne('App\SysTransactionsType', 'id', 'type');
    }
    
    public function operation(){
        return $this->hasOne('App\SysTransactionOperationType','id', 'operation');
    }
    
    public function bankDraft(){
        return $this->belongsTo('App\BankDraft')->with(['type_account', 'bank']);
    }
}
