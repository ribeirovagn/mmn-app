<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Level extends Model
{
    protected $fillable = [
        'type',
        'start',
        'end',
        'bonus_id',
        'product_id',
        'dots',
        'amount',
    ];
}
