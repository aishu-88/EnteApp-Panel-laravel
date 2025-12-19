<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }
    public function login(Request $request){
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required|min:6',
            
        ]);
        $user = Auth::user();

        $credentials = $request->only('email', 'password');

        if (Auth::guard('admin')->attempt($credentials, $request->filled('remember'))) {
            return redirect()->intended(route('admin.dashboard'));
        }

        return back()->withInput($request->only('email', 'remember'))
                     ->withErrors(['email' => 'These credentials do not match our records.']);
    }
}