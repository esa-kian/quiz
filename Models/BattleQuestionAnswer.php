<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BattleQuestionAnswer extends Model
{
    use HasFactory;

    public function battleQuestion()
    {
        return $this->belongsTo('App\Models\BattleQuestion');
    }
    
    public function users()
    {
        return $this->belongsToMany('App\Models\User', 'user_battle_answer');
    }
}
