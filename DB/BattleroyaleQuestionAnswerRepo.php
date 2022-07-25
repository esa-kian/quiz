<?php

namespace App\DB;

use App\Models\BattleroyaleQuestionAnswer;

class BattleroyaleQuestionAnswerRepo
{
    public function create($option, $answer, $battleroyale_question_id)
    {
        $battleroyaleQuestionAnswer = resolve(BattleroyaleQuestionAnswer::class);

        $battleroyaleQuestionAnswer->answer = $answer;

        $battleroyaleQuestionAnswer->text = $option;

        $battleroyaleQuestionAnswer->battleroyale_question_id = $battleroyale_question_id;

        $battleroyaleQuestionAnswer->save();
    }
}
