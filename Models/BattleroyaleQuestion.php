<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BattleroyaleQuestion extends Model
{
    use HasFactory;

    public function battleroyal()
    {
        return $this->belongsTo('App\Models\Battleroyale');
    }

    public function battleroyaleQuestionAnswer()
    {
        return $this->hasMany('App\Models\BattleroyaleQuestionAnswer');
    }
}
