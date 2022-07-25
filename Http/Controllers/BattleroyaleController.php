<?php

namespace App\Http\Controllers;

use App\DB\BattleroyaleRepo;
use Illuminate\Http\Request;
use Throwable;

class BattleroyaleController extends Controller
{
    public function index(BattleroyaleRepo $battleroyaleRepo)
    {
        return response(['battleroyales' => $battleroyaleRepo->all()], 200);
    }

    public function read($id, BattleroyaleRepo $battleroyaleRepo)
    {
        return response(['battleroyale' => $battleroyaleRepo->fetch($id)], 200);
    }

    public function create(Request $request, BattleroyaleRepo $battleroyaleRepo)
    {

        if ($this->checkNullValue($request->title)) {

            $status = $this->setStatus($request->status);

            if ($this->checkDatetimeValidation($request->start_date)) {

                $end_date = $this->setEndDate($request->start_date, 'battleroyale');

                return response(['battleroyale_id' => $battleroyaleRepo->create(
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

    public function update($id, Request $request, BattleroyaleRepo $battleroyaleRepo)
    {
        if ($this->checkNullValue($request->title)) {

            $status = $this->setStatus($request->status);

            if ($this->checkDatetimeValidation($request->start_date)) {

                $end_date = $this->setEndDate($request->start_date, 'battleroyale');

                return response(['battleroyale' => $battleroyaleRepo->edit(
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

    public function delete($id, BattleroyaleRepo $battleroyaleRepo)
    {
        try {
            $battleroyaleRepo->delete($id);

            return response(['message' => 'حذف با موفقیت انجام شد'], 200);
        } catch (Throwable $e) {
            return response(['error' => $e], 400);
        }
    }

    public function start(BattleroyaleRepo $battleroyaleRepo)
    {
        return response(['battleroyale' => $battleroyaleRepo->start(3)], 200);
    }

    public function submitAnswer(Request $request, BattleroyaleRepo $battleroyaleRepo)
    {

        return response(['answer' => $battleroyaleRepo->submit($request->question_id, $request->answer_id, 3)], 200);
    }
}
