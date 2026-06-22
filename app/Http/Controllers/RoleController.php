<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Function\Respons;
use Illuminate\Support\Str;

class RoleController extends Controller
{
    public function index(Request $request)
    {
        $parentUserId = Auth::id() ?? $request->user_id;
        $roles = Role::where('user_id', $parentUserId)->get();

        return Respons::success($roles);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'nullable|string|max:255',
            'permissions' => 'nullable|string',
        ]);

        $parentUserId = Auth::id() ?? $request->user_id;

        $role = Role::create([
            'user_id' => $parentUserId,
            'name' => $request->name,
            'type' => $request->type,
            'permissions' => $request->permissions,
        ]);

        return Respons::success($role);
    }

    public function update(Request $request, $id)
    {
        $parentUserId = Auth::id() ?? $request->user_id;
        $role = Role::where('id', $id)->where('user_id', $parentUserId)->firstOrFail();

        $request->validate([
            'name' => 'sometimes|string|max:255',
            'type' => 'sometimes|string|max:255',
            'permissions' => 'sometimes|string',
        ]);

        if ($request->has('name')) $role->name = $request->name;
        if ($request->has('type')) $role->type = $request->type;
        if ($request->has('permissions')) $role->permissions = $request->permissions;

        $role->save();

        return Respons::success($role);
    }

    public function destroy(Request $request, $id)
    {
        $parentUserId = Auth::id() ?? $request->user_id;
        $role = Role::where('id', $id)->where('user_id', $parentUserId)->firstOrFail();
        
        $role->delete();

        return Respons::success(['message' => 'تم حذف الدور بنجاح']);
    }
}
