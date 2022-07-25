<?php

namespace App\DB;

use App\Models\BattleroyaleQuestion;

class BattleroyaleQuestionRepo
{
    public function create($question, $photo, $video, $battleroyale_id)
    {
        $battleroyaleQuestion = resolve(BattleroyaleQuestion::class);

        $battleroyaleQuestion->question = $question;

        $battleroyaleQuestion->photo = $photo;

        $battleroyaleQuestion->video = $video;

        $battleroyaleQuestion->battleroyale_id = $battleroyale_id;

        $battleroyaleQuestion->save();

        return $battleroyaleQuestion;
    }
}
