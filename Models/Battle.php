<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Battle extends Model
{
    use HasFactory;

    public function battleQuestions()
    {
        return $this->hasMany('App\Models\BattleQuestion');
    }

    public function users()
    {
        return $this->belongsToMany('App\Models\User', 'user_battle');
    }
}
