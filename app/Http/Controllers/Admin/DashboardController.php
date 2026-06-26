<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        $query = User::where('role', 'hall');

        if (!empty($search)) {
            $query->where(function ($q) use ($search) {
                $q->where('email', 'like', '%' . $search . '%')
                  ->orWhere('username', 'like', '%' . $search . '%')
                  ->orWhere('hallname', 'like', '%' . $search . '%');
            });
        }

        $users = $query->orderBy('created_at', 'desc')->paginate(15);

        return view('admin.dashboard', compact('users', 'search'));
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:2,3,4',
        ]);

        $user = User::findOrFail($id);
        $user->status = $request->input('status');
        $user->save();

        return redirect()->back()->with('success', 'تم تحديث حالة المستخدم بنجاح.');
    }

    public function updateExpiration(Request $request, $id)
    {
        $request->validate([
            'date_experiment' => 'required|date',
        ]);

        $user = User::findOrFail($id);
        $user->date_experiment = $request->input('date_experiment');
        $user->save();

        return redirect()->back()->with('success', 'تم تحديث تاريخ انتهاء الصلاحية بنجاح.');
    }
}
