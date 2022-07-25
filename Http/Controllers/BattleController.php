<?php

namespace App\Http\Controllers;

use App\DB\BattleRepo;
use Illuminate\Http\Request;
use Throwable;

class BattleController extends Controller
{
    public function index(BattleRepo $battleRepo)
    {
        return response(['battles' => $battleRepo->all()], 200);
    }

    public function create(Request $request, BattleRepo $battleRepo)
    {

        if ($this->checkNullValue($request->title)) {

            $status = $this->setStatus($request->status);

            if ($this->checkDatetimeValidation($request->start_date)) {

                $end_date = $this->setEndDate($request->start_date, 'battle');

                return response(['battle_id' => $battleRepo->create(
                    $request->title,
                    $request->start_date,
                    $end_date,
                    $status
                )], 200);
            } else {

                return response(['message' => 'زمان شروع نامعتبر است'], 400);
            }
        } else {

            return response(['message' => 'مقدار عنوان نمیتواند خالی باشد'], 400);
        }
    }

    public function read($id, BattleRepo $battleRepo)
    {
        return response(['battle' => $battleRepo->fetch($id)], 200);
    }

    public function update($id, Request $request, BattleRepo $battleRepo)
    {
        if ($this->checkNullValue($request->title)) {

            $status = $this->setStatus($request->status);

            if ($this->checkDatetimeValidation($request->start_date)) {

                $end_date = $this->setEndDate($request->start_date, 'battle');

                return response(['battle' => $battleRepo->edit(
                    $id,
                    $request->title,
                    $request->start_date,
                    $end_date,
                    $status
                )], 200);
            } else {

                return response(['message' => 'زمان شروع نامعتبر است'], 400);
            }
        } else {

            return response(['message' => 'مقدار عنوان نمیتواند خالی باشد'], 400);
        }
    }

    public function delete($id, BattleRepo $battleRepo)
    {
        try {
            $battleRepo->delete($id);

            return response(['message' => 'حذف با موفقیت انجام شد'], 200);
        } catch (Throwable $e) {
            return response(['error' => $e], 400);
        }
    }

    public function start(BattleRepo $battleRepo)
    {
        return response(['battle' => $battleRepo->start(3)], 200);
    }

    public function submitAnswer(Request $request, BattleRepo $battleRepo)
    {

        return response(['answer' => $battleRepo->submit($request->question_id, $request->answer_id, 3)], 200);
    }
}
