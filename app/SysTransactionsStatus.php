<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SysTransactionsStatus extends Model
{
    protected $fillable = ['name'];
    
    protected $hidden = ['id', 'updated_at'];
}
