<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DotsBinary extends Model
{
    
    protected $fillable = [
        'user_id',
        'status',
        'description',
        'order_item_id',
        'dots',
        'side',
        'level'
    ];


    public function genealogy_resume(){
        return $this->hasOne('App\GenealogyResume', 'user_id');
    }
}
