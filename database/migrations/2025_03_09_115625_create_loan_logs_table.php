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
        Schema::create('loan_logs', function (Blueprint $table) {
            $table->increments('loan_log_id');
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('loan_id');
            $table->string('action', 100);
            $table->enum('level',  ['info', 'warning', 'error'])->default('info');
            $table->json('details')->nullable();
            $table->string('ip_address')->nullable();
            $table->timestamps();
            $table->foreign('user_id')->references('user_id')->on('users')->onDelete('cascade')->onUpdate('cascade')->index('idx_user_loan_logs');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('loan_logs');
    }
};
