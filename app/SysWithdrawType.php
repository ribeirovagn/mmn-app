<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SysWithdrawType extends Model
{
    protected $fillable = [
        'name',
        'is_active',
        'description'
    ];
}
