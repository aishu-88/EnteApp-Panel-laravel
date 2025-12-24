<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class MainCategorySeeder extends Seeder
{
    public function run(): void
    {
        DB::table('main_categories')->insert([
            [
                'name'   => 'Service',
                'slug'   => Str::slug('Service'),
                'status' => 'active',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name'   => 'Shop',
                'slug'   => Str::slug('Shop'),
                'status' => 'active',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
