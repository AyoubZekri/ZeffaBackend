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

            $user = User::with(['parent', 'roleDetails'])->where('email', $request->email)->first();

            if (!$user || !\Hash::check($request->password, $user->password)) {
                return Respons::error('البريد الإلكتروني أو كلمة المرور غير صحيحة', 422);
            }

            // التحقق من الصلاحيات: إما أن يكون المستخدم الأساسي (role='hall') أو مستخدم فرعي (له user_id)
            if ($user->user_id == null && $user->role != 'hall') {
                return Respons::error('ليس لديك الصلاحية لتسجيل الدخول', 403);
            }

            $token = $user->createToken('api_token')->plainTextToken;

            if ($request->filled('token')) {
                $user->update([
                    'token' => $request->token,
                ]);
            }

            // إذا كان المستخدم أساسياً، نجعل بيانات الـ parent هي نفس بياناته حتى لا يتعطل التطبيق في Flutter
            if ($user->user_id == null) {
                $user->setRelation('parent', $user);
            }

            $data = [
                'user' => $user,
                'token' => $token,
            ];

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
