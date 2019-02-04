<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BankDraft extends Model
{
    protected $fillable = [
        'user_id',
        'account_id',
        'bank_id',
        'crypto_id',
        'sys_type_account_withdraw_id',
        'agency',
        'account',
        'operation',
        'note',
        'doc_path',
        'verified'
    ];
    
    protected $hidden = [
        'sys_type_account_withdraw_id', 'user_id'
    ];
    
    public function type_account(){
        return $this->belongsTo('App\SysTypeAccountWithdraw', 'sys_type_account_withdraw_id');
    }
    
    public function bank(){
        return $this->belongsTo('App\Bank', 'bank_id');
    }
    
    public function crypto(){
        return $this->belongsTo('App\SysCrypto', 'crypto_id');
    }
    
}
