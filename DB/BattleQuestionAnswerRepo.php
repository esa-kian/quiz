<?php

namespace App\DB;

use App\Models\BattleQuestionAnswer;

class BattleQuestionAnswerRepo
{
    public function create($option, $answer, $battle_question_id)
    {
        $battleQuestionAnswer = resolve(BattleQuestionAnswer::class);

        $battleQuestionAnswer->answer = $answer;

        $battleQuestionAnswer->text = $option;

        $battleQuestionAnswer->battle_question_id = $battle_question_id;

        $battleQuestionAnswer->save();
    }
}
