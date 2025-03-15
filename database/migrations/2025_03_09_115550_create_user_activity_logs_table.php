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
        Schema::create('user_activity_logs', function (Blueprint $table) {
            $table->bigIncrements('activity_log_id');
            $table->unsignedInteger('user_id');
            $table->string('action', 100);
            $table->enum('level', ['info', 'warning', 'error'])->default('info');
            $table->string('table_name', 50)->nullable();
            $table->unsignedInteger('record_id')->nullable();
            $table->json('old_data')->nullable();
            $table->json('new_data')->nullable();
            $table->string('ip_address')->nullable();
            $table->timestamps();
            $table->foreign('user_id')->references('user_id')->on('users')->onDelete('cascade')->onUpdate('cascade')->index('idx_user_activity_logs');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_activity_logs');
    }
};
