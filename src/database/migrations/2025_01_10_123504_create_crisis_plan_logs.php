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
        Schema::create('crisis_plan_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('crisis_plan_id')->constrained()->OnDelete('cascade');
            $table->date('input_date');
            $table->json('good_actions')->nullable();
            $table->json('neutral_actions')->nullable();
            $table->json('bad_actions')->nullable();
            $table->timestamps();

            $table->unique(['user_id', 'input_date']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('crisis_plan_logs');
    }
};
