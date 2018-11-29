<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LevelStatus extends Model
{
    protected $fillable = [
        'level_id',
        'sys_user_status_id',
    ];
    
    public $timestamps = false;
}
