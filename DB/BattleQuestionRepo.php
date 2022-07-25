<?php

namespace App\DB;

use App\Models\BattleQuestion;

class BattleQuestionRepo
{
    public function create($question, $photo, $video, $battle_id)
    {
        $battleQuestion = resolve(BattleQuestion::class);

        $battleQuestion->question = $question;

        $battleQuestion->photo = $photo;

        $battleQuestion->video = $video;

        $battleQuestion->battle_id = $battle_id;

        $battleQuestion->save();

        return $battleQuestion;
    }
}
