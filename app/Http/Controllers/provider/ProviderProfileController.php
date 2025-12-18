<?php

namespace App\Http\Controllers\Provider;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ProviderProfileController extends Controller
{
    public function edit(Request $request)
    {
        return view('provider.provider_profile', [
            'user' => $request->user(),
        ]);
    }

    public function update(Request $request)
    {
        $request->validate([
            'mobile'   => 'nullable|string|max:20',
            'whatsapp' => 'nullable|string|max:20',
        ]);

        $user = $request->user();
        $user->mobile = $request->mobile;
        $user->whatsapp = $request->whatsapp;
        $user->save();

        return back()->with('success', 'Profile updated successfully.');
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required|current_password',
            'password'         => 'required|min:8|confirmed',
        ]);

        $user = $request->user();
        $user->password = Hash::make($request->password);
        $user->save();

        return back()->with('success', 'Password updated successfully.');
    }
}
