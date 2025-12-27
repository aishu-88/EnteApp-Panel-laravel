<?php
namespace App\Http\Controllers\Provider;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Storage;

class AuthController extends Controller
{
    /* ================= REGISTER FORM ================= */
    public function showRegister()
    {
        return view('provider.auth.register');
    }

    /* ================= REGISTER STORE ================= */public function register(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email',
        'phone' => 'required|string|max:15|unique:users,phone',
        'aadhaar_number' => 'required|string|max:12',
        'bank_account_number' => 'required|string',
        'password' => 'required|confirmed|min:6',
        'profile_image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        'terms' => 'required',
    ], [
        'email.unique' => 'This email is already registered.',
        'phone.unique' => 'This phone number is already registered.',
        'terms.required' => 'You must agree to the terms and conditions.',
    ]);

    // Handle profile image
    $profileImagePath = null;
    if ($request->hasFile('profile_image')) {
        $profileImagePath = $request->file('profile_image')->store('providers', 'public');
    }

    // Save user as service provider
    $user = User::create([
        'name' => $request->name,
        'email' => $request->email,
        'phone' => $request->phone,
        'aadhaar_number' => $request->aadhaar_number,
        'bank_account_number' => $request->bank_account_number,
        'password' => Hash::make($request->password),
        'profile_image' => $profileImagePath,
        'user_type' => 'service_provider',
    ]);

    return redirect()->route('provider.login')
                     ->with('success', 'Registration successful! Please login.');
}


    // Show login form
    public function showLogin()
    {
        return view('provider.auth.login');
    }

    // Handle login
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (auth()->attempt($request->only('email', 'password'))) {
            return redirect()->route('provider.dashboard'); // make sure dashboard route exists
        }

        return back()->withErrors(['email' => 'Invalid credentials'])->withInput();
    }
}
