<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TransactionStatus extends Model
{
    protected $fillable = ['transaction_id', 'status', 'note'];
    
    
    public function transaction(){
        return $this->belongsTo('App\Transaction');
    }
}
