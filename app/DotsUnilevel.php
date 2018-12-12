<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DotsUnilevel extends Model
{
    protected $fillable = [
        'description',
        'user_id',
        'references_id',
        'dots',
        'status',
        'type',
        'level'
    ];
}
