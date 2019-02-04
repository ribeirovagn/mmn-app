<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SysTypeAccountWithdraw extends Model
{
    protected $fillable = [
        'name',
        'note',
        'is_active'
    ];
    
    protected $hidden = [
        'created_at',
        'updated_at',
        'is_active'
    ];
}
