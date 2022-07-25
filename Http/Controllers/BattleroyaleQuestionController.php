<?php

namespace App\Http\Controllers;

use App\DB\BattleroyaleQuestionAnswerRepo;
use App\DB\BattleroyaleQuestionRepo;
use App\DB\BattleroyaleRepo;
use Illuminate\Http\Request;

class BattleroyaleQuestionController extends Controller
{
    public function create(
        $id,
        Request $request,
        BattleroyaleQuestionRepo $battleroyaleQuestionRepo,
        BattleroyaleQuestionAnswerRepo $battleroyaleQuestionAnswerRepo
    ) {
        if ($this->checkNullValue($request->question)) {

            $photo = $this->saveFile($request->photo, 'battle');

            $video = $this->saveFile($request->video, 'battle');

            $battleroyaleQuestion = $battleroyaleQuestionRepo->create($request->question, $photo, $video, $id);

            if ($this->checkAnswers($request->answer_1, $request->answer_2, $request->answer_3, $request->answer_4)) {

                if ($this->checkNullValue($request->option_1)) {

                    if ($this->checkNullValue($request->option_2)) {

                        if ($this->checkNullValue($request->option_3)) {

                            if ($this->checkNullValue($request->option_4)) {

                                $battleroyaleQuestionAnswerRepo->create($request->option_1, $request->answer_1, $battleroyaleQuestion->id);
                                $battleroyaleQuestionAnswerRepo->create($request->option_2, $request->answer_2, $battleroyaleQuestion->id);
                                $battleroyaleQuestionAnswerRepo->create($request->option_3, $request->answer_3, $battleroyaleQuestion->id);
                                $battleroyaleQuestionAnswerRepo->create($request->option_4, $request->answer_4, $battleroyaleQuestion->id);
                            } else {

                                return response(['message' => 'متن گزینه چهارم نمیتواند خالی باشد'], 400);
                            }
                        } else {

                            return response(['message' => 'متن گزینه سوم نمیتواند خالی باشد'], 400);
                        }
                    } else {

                        return response(['message' => 'متن گزینه دوم نمیتواند خالی باشد'], 400);
                    }
                } else {

                    return response(['message' => 'متن گزینه اول نمیتواند خالی باشد'], 400);
                }
            } else {

                return response(['message' => ' یکی از گزینه ها باید پاسخ درست باشد'], 400);
            }

            $battleroyaleRepo = resolve(BattleroyaleRepo::class);

            $battleroyale = $battleroyaleRepo->fetch($id);

            return response(['battleroyale' => $battleroyale], 200);
        } else {

            return response(['message' => 'متن سوال نمیتواند خالی باشد'], 400);
        }
    }
}
