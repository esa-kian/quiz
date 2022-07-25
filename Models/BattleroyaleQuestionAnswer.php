<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BattleroyaleQuestionAnswer extends Model
{
    use HasFactory;

    public function battleroyaleQuestion()
    {
        return $this->belongsTo('App\Models\BattleroyaleQuestion');
    }

    public function users()
    {
        return $this->belongsToMany('App\Models\User');
    }
}
