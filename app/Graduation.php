<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Graduation extends Model
{
    protected $fillable = [
        'name',
        'figure',
        'ordinal',
        'limit',
        'dots_start',
        'dots_end'
    ];
}
