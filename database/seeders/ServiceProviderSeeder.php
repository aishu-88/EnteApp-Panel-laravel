<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class ServiceProviderSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            [
                'email' => 'serviceprovider@example.com',
            ],
            [
                'name' => 'Service Provider',
                'password' => Hash::make('password123'),
                'user_type' => 'service_provider',
                'status' => 'active',
                'email_verified_at' => now(),
            ]
        );
    }
}
