<?php

namespace App\Http\Controllers\Auth;

use App\Function\Respons;
use App\Function\UserService;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Zakat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class RegisterController extends Controller
{

    public function RegisterUser(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                "adresse" => "nullable|string|max:255",
                'username' => 'required|string|max:255',
                'hallname' => 'required|string|max:255',
                'numperPhone' => 'required|string|max:12',
                'email' => 'required|email',
                'password' => 'required|string|min:6|confirmed',
                'token' => 'nullable|string|max:255',
            ]);

            if ($validator->fails()) {
                return Respons::error('بيانات غير صحيحة', 422, $validator->errors());
            }

            $existingUser = User::where('email', $request->email)->first();
            if ($existingUser) {

                return Respons::error('البريد الإلكتروني مستخدم مسبقاً', 422, [
                    'البريد الإلكتروني مستخدم مسبقاً'
                ]);

            }

            $result = UserService::createUserWithRole(
                $request->only(['username', 'hallname', 'adresse', 'numperPhone', 'email', 'password', 'token']),
                "User"
            );

            return Respons::success();


        } catch (\Exception $e) {
            return Respons::error('حدث خطأ أثناء إنشاء حساب المستخدم', 500, $e->getMessage());

        }
    }

    public function getuser()
    {

        try {
            $user = User::where("id", auth()->id())->get();
            return Respons::success(['data' => $user]);
        } catch (\Exception $th) {
            return Respons::error('المستخدم غير موجودة', 404);
        }

    }




}

