<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Create roles table
        Schema::create('roles', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique(); // e.g., 'admin', 'service_provider', 'shop_owner', 'user'
            $table->string('description')->nullable();
            $table->timestamps();
        });

        // Create pivot table for user-role many-to-many relationship
        Schema::create('user_role', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('role_id')->constrained('roles')->onDelete('cascade');
            $table->timestamps();

            $table->unique(['user_id', 'role_id']); // Prevent duplicate assignments
        });

        // Seed default roles (optional, but recommended)
        DB::table('roles')->insert([
            ['name' => 'admin', 'description' => 'System administrator'],
            ['name' => 'service_provider', 'description' => 'Service provider user'],
            ['name' => 'shop_owner', 'description' => 'Shop owner user'],
            ['name' => 'user', 'description' => 'Regular user'],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_role');
        Schema::dropIfExists('roles');
    }
};