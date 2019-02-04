<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SysCrypto extends Model
{
    protected $fillable = [
        'name',
        'abbreviation'
    ];
    
    protected $hidden = [
        'id',
        'created_at',
        'updated_at'
    ];
}
