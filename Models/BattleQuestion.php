<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BattleQuestion extends Model
{
    use HasFactory;

    public function battle()
    {
        return $this->belongsTo('App\Models\Battle');
    }

    public function battleQuestionAnswer()
    {
        return $this->hasMany('App\Models\BattleQuestionAnswer');
    }
}
