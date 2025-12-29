<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class StaffController extends Controller
{
    public function employees()
    {
        $users = User::where('user_type', 'service_provider')
            ->latest()
            ->paginate(10);

        return view('admin.employee', compact('users'));
    }


    public function rolesPermissions()
    {
        return view('admin.permission');
    }

    public function activityLogs()
    {
        return view('admin.activity-logs');
    }
    public function show($id)
    {
        $user = User::findOrFail($id);
        return view('admin.users.show', compact('user'));
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('admin.users.edit', compact('user'));
    }

    public function destroy($id)
    {
        User::findOrFail($id)->delete();

        return redirect()
            ->route('admin.users.index')
            ->with('success', 'User deleted successfully');
    }
}
