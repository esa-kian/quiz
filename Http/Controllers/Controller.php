<?php

namespace App\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;
use DateTime;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Log;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function checkNullValue($value)
    {
        if ($value) {
            return true;
        } else {
            return false;
        }
    }

    public function checkAnswers($answer_1, $answer_2, $answer_3, $answer_4)
    {
      
        if (($answer_1 == '1' &&  $answer_2 == '0' && $answer_3 == '0' && $answer_4 =='0') ||
            ($answer_1 == '0' &&  $answer_2 == '1' && $answer_3 == '0' && $answer_4 == '0') ||
            ($answer_1 == '0' &&  $answer_2 == '0' && $answer_3 == '1' && $answer_4 == '0') ||
            ($answer_1 == '0' &&  $answer_2 == '0' && $answer_3 == '0' && $answer_4 == '1')
        ) {
            return true;
        } else {
            return false;
        }
    }

    public function setStatus($status)
    {
        // active/admin/verify
        if ($status == 'true') {
            return 1;
        } // deactive/user/not verify
        else {
            return 0;
        }
    }

    // check datetime values is valid 
    public function checkDatetimeValidation($datetime)
    {
        $format = 'Y-m-d H:i:s';

        $d = DateTime::createFromFormat($format, $datetime);

        return $d && $d->format($format) == $datetime;
    }

    // set end date for battles after 24 hours
    public function setEndDate($start_date, $type)
    {
        if ($type == 'battle') {

            return Carbon::parse($start_date)->addDays(1);
        } elseif ($type == 'battleroyale') {

            return Carbon::parse($start_date)->addDays(30);
        }
    }

    public function saveFile($file, $type)
    {
        if ($file) {

            if ($type == 'battle') {

                $file_name = Carbon::now()  . '.' . $file->getClientOriginalExtension();

                $file->move(public_path('/battles/'), $file_name);

                return '/battles/' . $file_name;
            } elseif ($type == 'battleroyale') {

                $file_name = Carbon::now()  . '.' . $file->getClientOriginalExtension();

                $file->move(public_path('/battleroyales/'), $file_name);

                return '/battles/' . $file_name;
            }
        } else {

            return '';
        }
    }

    public function checkUniqueMobile($mobile)
    {
        if (User::where('mobile', $mobile)->first()) {

            return false;
        } else {

            return true;
        }
    }
}
