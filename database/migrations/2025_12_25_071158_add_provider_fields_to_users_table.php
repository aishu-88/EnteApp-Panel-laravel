<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {

            $table->string('aadhaar_number', 12)->nullable()->after('phone');

            $table->string('bank_account_number', 30)->nullable()->after('aadhaar_number');

            $table->boolean('terms_accepted')
                  ->default(false)
                  ->after('bank_account_number');

            $table->boolean('is_service_provider')
                  ->default(false)
                  ->after('user_type');

            $table->enum('provider_status', ['pending', 'approved', 'rejected'])
                  ->nullable()
                  ->after('status');

            $table->string('profile_image')->nullable()->after('avatar');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'aadhaar_number',
                'bank_account_number',
                'terms_accepted',
                'is_service_provider',
                'provider_status',
                'profile_image'
            ]);
        });
    }
};
