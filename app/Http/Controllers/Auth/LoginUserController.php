<?php

namespace App\Http\Controllers\Auth;

use App\Function\Login;
use App\Function\Notification;
use App\Function\Respons;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Exception;

class LoginUserController extends Controller
{
    public function login(Request $request)
    {
        try {
            $request->validate([
                'email' => 'required|email',
                'password' => 'required|string',
                'token' => 'nullable|string',
            ]);

            $data = Login::loginUser($request->email, $request->password, "hall");

            $user = User::where('email', $request->email)->first();

            if ($request->filled('token')) {
                $user->update([
                    'token' => $request->token,
                ]);
            }

            // $notification = new Notification();
            // $result = $notification->sendNotificationToTopic('users', 'تنبيه جديد', 'هذا إشعار جماعي');

            return Respons::success([
                'user' => $data,
            ], 'تم تسجيل الدخول بنجاح');

        } catch (ValidationException $e) {
            return Respons::error('بيانات الدخول غير صحيحة', 422, $e->errors());
        } catch (Exception $e) {
            return Respons::error('حدث خطأ أثناء محاولة تسجيل الدخول', 500, $e->getMessage());
        }
    }
}
