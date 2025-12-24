<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AdminUserSeeder extends Seeder
{
    public function run()
    {
        User::updateOrCreate(
            ['email' => 'admin@example.com'],
            [
                'name'  => 'Admin',
                'phone' => '9999999999', // ✅ REQUIRED
                'password' => Hash::make('password123'),
                'user_type' => 'admin',
                'status' => 'active',
            ]
        );
    }
}
