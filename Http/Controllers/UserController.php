<?php

namespace App\Http\Controllers;

use App\DB\UserRepo;
use Illuminate\Http\Request;
use Throwable;

class UserController extends Controller
{
    public function index(UserRepo $userRepo)
    {
        return response(['users' => $userRepo->all()], 200);
    }

    public function create(Request $request, UserRepo $userRepo)
    {
        if ($this->checkNullValue($request->mobile)) {

            if ($this->checkUniqueMobile($request->mobile)) {

                $level = $this->setStatus($request->level);

                $status = $this->setStatus($request->status);

                $verify = $this->setStatus($request->verify);

                return response(
                    ['user' => $userRepo->create($request->mobile, $request->name, $level, $status, $verify)],
                    200
                );
            } else {

                return response(['message' => 'این شماره موبایل قبلا استفاده شده است'], 400);
            }
        } else {

            return response(['message' => 'شماره موبایل نمیتواند خالی باشد'], 400);
        }
    }

    public function read($id, UserRepo $userRepo)
    {
        return response(['user' => $userRepo->fetch($id)], 200);
    }

    public function update()
    {
    }

    public function delete($id, UserRepo $userRepo)
    {
        try {
            $userRepo->delete($id);

            return response(['message' => 'حذف با موفقیت انجام شد'], 200);
        } catch (Throwable $e) {
            
            return response(['error' => $e], 400);
        }
    }
}
