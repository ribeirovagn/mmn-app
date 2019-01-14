<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transactions extends Model
{
    protected $fillable = ['user_id', 'references_id', 'value', 'status', 'type', 'level', 'related'];
    
    public function statuses(){
        return $this->hasMany('App\TransactionStatus', 'transaction_id');
    }
}
