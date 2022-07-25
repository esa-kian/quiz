<?php

namespace App\DB;

use App\Http\Resources\BattleResource;
use App\Models\Battle;
use App\Models\BattleQuestion;
use App\Models\BattleQuestionAnswer;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Throwable;

class BattleRepo
{
    public function all()
    {
        return Battle::all();
    }

    public function fetch($battle_id)
    {
        return Battle::where('id', $battle_id)->with('battleQuestions', 'battleQuestions.battleQuestionAnswer')->get();
    }

    public function create($title, $start_date, $end_date, $status)
    {
        $battle = resolve(Battle::class);

        $battle->title = $title;

        $battle->start_date = $start_date;

        $battle->end_date = $end_date;

        $battle->status = $status;

        $battle->save();

        return $battle->id;
    }

    public function edit($battle_id, $title, $start_date, $end_date, $status)
    {

        try {
            Battle::where('id', $battle_id)->update([
                'title' => $title,
                'start_date' => $start_date,
                'end_date' => $end_date,
                'status' => $status
            ]);

            return 'بروزرسانی با موفقیت انجام شد';
        } catch (Throwable $e) {

            return response(['message' => 'خطایی رخ داد', 'error' => $e], 500);
        }
    }

    public function delete($battle_id)
    {
        $battle = Battle::find($battle_id);

        $battle->delete();
    }

    public function start($user_id)
    {

        $battle = BattleResource::collection(Battle::where('start_date', '<=', Carbon::now())
            ->where('end_date', '>=', Carbon::now())
            ->where('status', 1)
            ->with('battleQuestions:id,battle_id,question,photo,video', 'battleQuestions.battleQuestionAnswer')
            ->select('id', 'title', 'start_date', 'end_date')
            ->get());

        foreach ($battle as $b) {
            DB::table('user_battle')->insert([
                'battle_id' => $b->id,
                'user_id' => $user_id
            ]);
        }

        return $battle;
    }

    public function submit($question_id, $answer_id, $user_id)
    {
        // $user_id = auth()->guard('api')->id()
        $user = User::find($user_id);

        $answer = BattleQuestionAnswer::find($answer_id);

        $question = DB::table('user_battle_answer')
            ->where('battle_question_id', $answer->battle_question_id)
            ->count();

        if ($question > 0) {
            return ['message' => ' شما به این سوال پاسخ داده اید', 'status' => false];
        }

        DB::table('user_battle_answer')->insert([
            'battle_question_id' => $question_id,
            'battle_answer_id' => $answer->id,
            'user_id' => $user->id
        ]);

        if ($answer->answer == 0) {
            return ['message' => 'پاسخ غلط', 'status' => false];
        } else {
            return ['message' => 'پاسخ درست', 'status' => true];
        }
    }
}
