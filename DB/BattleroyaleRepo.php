<?php

namespace App\DB;

use App\Http\Resources\BattleroyaleResource;
use App\Models\Battleroyale;
use App\Models\BattleroyaleQuestionAnswer;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Throwable;

class BattleroyaleRepo
{
    public function all()
    {
        return Battleroyale::all();
    }

    public function fetch($battleroyale_id)
    {
        return Battleroyale::where('id', $battleroyale_id)->with('battleroyaleQuestions', 'battleroyaleQuestions.battleroyaleQuestionAnswer')->get();
    }

    public function create($title, $start_date, $end_date, $status)
    {
        $battleroyale = resolve(Battleroyale::class);

        $battleroyale->title = $title;

        $battleroyale->start_date = $start_date;

        $battleroyale->end_date = $end_date;

        $battleroyale->status = $status;

        $battleroyale->save();

        return $battleroyale->id;
    }

    public function edit($battleroyale_id, $title, $start_date, $end_date, $status)
    {
        try {
            Battleroyale::where('id', $battleroyale_id)->update([
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

    public function delete($battleroyale_id)
    {
        $battleroyale = Battleroyale::find($battleroyale_id);

        $battleroyale->delete();
    }

    public function start($user_id)
    {

        $battleroyale = BattleroyaleResource::collection(Battleroyale::where('start_date', '<=',  Carbon::now())
            ->where('end_date', '>=',  Carbon::now())
            ->where('status', 1)
            ->with('battleroyaleQuestions:id,battleroyale_id,question,photo,video', 'battleroyaleQuestions.battleroyaleQuestionAnswer')
            ->select('id', 'title', 'start_date', 'end_date')
            ->get());

        foreach ($battleroyale as $b) {
            DB::table('user_battleroyale')->insert([
                'battleroyale_id' => $b->id,
                'user_id' => $user_id
            ]);
        }
        
        return $battleroyale;
    }

    public function submit($question_id, $answer_id, $user_id)
    {
        // $user_id = auth()->guard('api')->id()
        $user = User::find($user_id);

        $answer = BattleroyaleQuestionAnswer::find($answer_id);

        $question = DB::table('user_battleroyale_answer')
            ->where('battleroyale_question_id', $answer->battleroyale_question_id)
            ->count();

        if ($question > 0) {
            return ['message' => ' شما به این سوال پاسخ داده اید', 'status' => false];
        }

        DB::table('user_battleroyale_answer')->insert([
            'battleroyale_question_id' => $question_id,
            'battleroyale_question_answer_id' => $answer->id,
            'user_id' => $user->id
        ]);

        if ($answer->answer == 0) {
            return ['message' => 'پاسخ غلط', 'status' => false];
        } else {
            return ['message' => 'پاسخ درست', 'status' => true];
        }
    }
}
