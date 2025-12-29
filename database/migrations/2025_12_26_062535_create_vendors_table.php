<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('vendors', function (Blueprint $table) {
            $table->id();

            $table->foreignId('provider_id')
                ->constrained('users')
                ->onDelete('cascade');

            $table->string('shop_name');
            $table->string('owner_name')->nullable();
            $table->string('mobile');
            $table->string('whatsapp')->nullable();
            $table->string('email')->nullable();

            $table->string('digipin', 10)->nullable();
            $table->text('address')->nullable();
            $table->string('google_map')->nullable();
            $table->string('service_area')->nullable();

            $table->foreignId('main_category_id')
                ->constrained('main_categories');

            $table->foreignId('category_id')
                ->constrained('categories');

            $table->foreignId('plan_id')
                ->constrained('plans');

            $table->time('opening_time')->nullable();
            $table->time('closing_time')->nullable();

            $table->string('payment_mode')->nullable();
            $table->string('transaction_id')->nullable();
            $table->string('reference_number')->nullable();

            $table->string('photo')->nullable();
            $table->json('gallery')->nullable();
            $table->json('social_links')->nullable();

            $table->text('special_recommendation')->nullable();
            $table->text('internal_comments')->nullable();

            $table->enum('verification_status', ['pending', 'approved', 'rejected'])
                ->default('pending');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('vendors');
    }
};
