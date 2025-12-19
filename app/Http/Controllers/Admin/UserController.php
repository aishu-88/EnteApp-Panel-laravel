<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    
    public function allUsers(Request $request)
    {
        // Query users with pagination and optional search
        $users = User::query()
            ->when($request->search, function ($query, $search) {
                return $query->where('name', 'like', "%{$search}%")
                             ->orWhere('email', 'like', "%{$search}%");
            })
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('admin.all_users', compact('users'));
    }

   public function serviceProviders()
{
    $users = User::where('user_type', 'service_provider')->get();

    return view('admin.service_provider', compact('users'));
}


    public function shopOwners()
    {
        $users = User::where('user_type', 'shop_owner')->paginate(10);
        return view('admin.shop_owners', compact('users'));
    }

    public function verificationRequests()
{
    $requests = User::where('status', 'pending')->paginate(10);
    return view('admin.verification', compact('requests'));
}


    public function blockedUsers()
    {
        $users = User::where('status', 'blocked')->paginate(10);
        return view('admin.blocked_user', compact('users'));
    }

    // Additional methods for user actions
    public function block($id)
    {
        $user = User::findOrFail($id);
        $user->update(['status' => 'blocked']);
        return back()->with('success', 'User blocked successfully.');
    }

    public function unblock($id)
    {
        $user = User::findOrFail($id);
        $user->update(['status' => 'active']);
        return back()->with('success', 'User unblocked successfully.');
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

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $id,
            'user_type' => 'required|string',
            'status' => 'required|in:active,pending,blocked,inactive',
        ]);

        $user->update($request->only(['name', 'email', 'user_type', 'status']));

        return back()->with('success', 'User updated successfully.');
    }
}