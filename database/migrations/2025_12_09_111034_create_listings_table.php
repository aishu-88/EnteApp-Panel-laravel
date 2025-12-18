<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('listings', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description');
            $table->enum('type', ['service', 'shop'])->default('service');
            $table->string('provider_name');
            $table->foreignId('provider_id')->constrained('users')->onDelete('cascade');
            $table->string('icon')->nullable();
            $table->enum('status', ['active', 'pending', 'inactive'])->default('pending');
            $table->boolean('featured')->default(false);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('listings');
    }
};