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
    
    
    public function genealogy_resume(){
        return $this->hasOne('App\GenealogyResume', 'user_id');
    }
}
