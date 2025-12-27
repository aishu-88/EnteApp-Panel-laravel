<?php

namespace App\Http\Controllers\provider;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ProviderRegisterController extends Controller
{
    public function showForm()
    {
        return view('auth.provider-register');
    }

    public function register(Request $request)
    {
        // logic
    }
}
