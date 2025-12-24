<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    public function up(): void
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->id();

            // 🔗 Relation to Main Category
            $table->foreignId('main_category_id')
                  ->constrained('main_categories')
                  ->cascadeOnDelete();

            $table->string('name');              // Electrician, Grocery
            $table->text('description')->nullable();
            $table->enum('status', ['active', 'inactive'])
                  ->default('active');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('categories');
    }
};
