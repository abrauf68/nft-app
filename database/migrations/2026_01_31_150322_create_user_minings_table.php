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
        Schema::create('user_minings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('mining_machine_id')->constrained()->cascadeOnDelete();
            $table->decimal('total_earned', 14, 8)->default(0);
            $table->decimal('daily_reward', 14, 8); // snapshot at purchase
            $table->date('start_date');
            $table->date('end_date');
            $table->enum('status', ['running', 'completed', 'cancelled'])
                ->default('running');
            $table->timestamp('last_mined_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_minings');
    }
};
