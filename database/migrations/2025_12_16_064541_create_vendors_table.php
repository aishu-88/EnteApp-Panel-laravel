<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('vendors', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('provider_id');

            $table->string('shop_name');

            // ✅ FIXED CATEGORY STRUCTURE
            $table->unsignedBigInteger('main_category_id');
            $table->unsignedBigInteger('category_id');

            $table->string('owner_name')->nullable();

            $table->string('mobile', 20);
            $table->string('whatsapp', 20)->nullable();

            $table->text('address')->nullable();
            $table->string('panchayath')->nullable();

            $table->string('google_map')->nullable();

            $table->time('opening_time')->nullable();
            $table->time('closing_time')->nullable();

            $table->string('service_area')->nullable();
            $table->text('description')->nullable();

            $table->string('photo')->nullable();
            $table->longText('gallery')->nullable();

            $table->integer('plan_id');

            $table->string('verification_status')->default('Pending');
            $table->boolean('is_active')->default(true);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('vendors');
    }
};
