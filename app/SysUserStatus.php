<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SysUserStatus extends Model
{
    protected $fillable = [
        'name'
    ];
    
    public $timestamps = false;
}
