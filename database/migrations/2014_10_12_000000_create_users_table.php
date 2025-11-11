<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('username')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->foreignId('inviter_id')->nullable()->constrained('users')->nullOnDelete();
            $table->enum('is_active', ['active', 'inactive'])->default('active');
            $table->string('provider')->nullable();
            $table->string('provider_id')->nullable();
            $table->string('otp')->nullable();
            $table->timestamp('otp_expires_at')->nullable();
            $table->timestamp('otp_verified_at')->nullable();
            $table->timestamps();
            $table->softDeletes(); // This adds the 'deleted_at' column
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
