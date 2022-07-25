<?php

namespace App\DB;

use App\Models\User;

class UserRepo
{
    public function all()
    {
        return User::all();
    }

    public function fetch($user_id)
    {
        return User::where('id', $user_id)->with(
            'battles',
            'battleAnswers',
            'battleAnswers.battleQuestion',
            'battleroyales',
            'battleroyaleAnswers',
            'battleroyaleAnswers.battleroyaleQuestion',
        )->get();
    }

    public function create($mobile, $name, $level, $status, $verify)
    {
        $user = resolve(User::class);

        $user->mobile = $mobile;

        $user->name = $name;

        $user->level = $level;

        $user->status = $status;

        $user->verified = $verify;

        $user->save();

        return $user;
    }

    public function delete($user_id)
    {
        $user = User::find($user_id);

        $user->delete();
    }
}
