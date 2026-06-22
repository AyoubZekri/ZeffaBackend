<?php

namespace App\Http\Controllers;

use App\Function\Respons;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class SubUserController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'username' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6',
            'role_id' => 'required|exists:roles,id',
        ]);

        $parentUserId = Auth::id() ?? $request->user_id;

        $user = User::create([
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role_id' => $request->role_id,
            'user_id' => $parentUserId,
        ]);

        return Respons::success($user);

    }
    public function index(Request $request)
    {
        $parentUserId = Auth::id() ?? $request->user_id;
        $users = User::with('roleDetails')->where('user_id', $parentUserId)->get();

        return Respons::success($users);
    }

    public function update(Request $request, $id)
    {
        $parentUserId = Auth::id() ?? $request->user_id;
        $user = User::where('id', $id)->where('user_id', $parentUserId)->firstOrFail();

        $request->validate([
            'username' => 'sometimes|string|max:255',
            'email' => 'sometimes|string|email|max:255|unique:users,email,'.$id,
            'password' => 'sometimes|string|min:6',
            'role_id' => 'sometimes|exists:roles,id',
        ]);

        if ($request->has('username')) $user->username = $request->username;
        if ($request->has('email')) $user->email = $request->email;
        if ($request->has('password')) $user->password = Hash::make($request->password);
        if ($request->has('role_id')) $user->role_id = $request->role_id;

        $user->save();

        return Respons::success($user);
    }

    public function destroy(Request $request, $id)
    {
        $parentUserId = Auth::id() ?? $request->user_id;
        $user = User::where('id', $id)->where('user_id', $parentUserId)->firstOrFail();
        
        $user->delete();

        return Respons::success(['message' => 'تم حذف المستخدم بنجاح']);
    }
}
