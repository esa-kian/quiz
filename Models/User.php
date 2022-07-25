<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'mobile',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function battles()
    {
        return $this->belongsToMany('App\Models\Battle', 'user_battle');
    }

    public function battleAnswers()
    {
        return $this->belongsToMany('App\Models\BattleQuestionAnswer', 'user_battle_answer');
    }

    public function battleroyales()
    {
        return $this->belongsToMany('App\Models\Battleroyale', 'user_battleroyale');
    }

    public function battleroyaleAnswers()
    {
        return $this->belongsToMany('App\Models\BattleroyaleQuestionAnswer', 'user_battleroyale_answer');
    }
}
