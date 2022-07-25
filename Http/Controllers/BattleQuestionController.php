<?php

namespace App\Http\Controllers;

use App\DB\BattleQuestionAnswerRepo;
use App\DB\BattleQuestionRepo;
use App\DB\BattleRepo;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class BattleQuestionController extends Controller
{
    public function create(
        $id,
        Request $request,
        BattleQuestionRepo $battleQuestionRepo,
        BattleQuestionAnswerRepo $battleQuestionAnswerRepo
    ) {
        if ($this->checkNullValue($request->question)) {

            $photo = $this->saveFile($request->photo, 'battle');

            $video = $this->saveFile($request->video, 'battle');

            $battleQuestion = $battleQuestionRepo->create($request->question, $photo, $video, $id);

            if ($this->checkAnswers($request->answer_1, $request->answer_2, $request->answer_3, $request->answer_4)) {

                if ($this->checkNullValue($request->option_1)) {

                    if ($this->checkNullValue($request->option_2)) {

                        if ($this->checkNullValue($request->option_3)) {

                            if ($this->checkNullValue($request->option_4)) {

                                $battleQuestionAnswerRepo->create($request->option_1, $request->answer_1, $battleQuestion->id);
                                $battleQuestionAnswerRepo->create($request->option_2, $request->answer_2, $battleQuestion->id);
                                $battleQuestionAnswerRepo->create($request->option_3, $request->answer_3, $battleQuestion->id);
                                $battleQuestionAnswerRepo->create($request->option_4, $request->answer_4, $battleQuestion->id);
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

            $battleRepo = resolve(BattleRepo::class);

            $battle = $battleRepo->fetch($id);

            return response(['battle' => $battle], 200);
        } else {

            return response(['message' => 'متن سوال نمیتواند خالی باشد'], 400);
        }
    }
}
