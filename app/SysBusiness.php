<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SysBusiness extends Model
{
    protected $fillable = ['binary', 'unilevel', 'leadership_balance'];
    
    protected $hidden = ['created_at', 'updated_at', 'id'];
}
