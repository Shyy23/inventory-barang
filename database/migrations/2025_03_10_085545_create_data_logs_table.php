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
        Schema::create('data_logs', function (Blueprint $table) {
            $table->bigIncrements('data_log_id');
            $table->unsignedInteger('user_id');
            $table->string('table_name', 50);
            $table->unsignedInteger('record_id');
            $table->string('action', 100);
            $table->enum('level', ['info', 'warning', 'error'])->default('info');
            $table->json('old_data')->nullable();
            $table->json('new_data')->nullable();
            $table->timestamps();
            $table->foreign('user_id')->references('user_id')->on('users')->onDelete('cascade')->onUpdate('cascade')->index('idx_user_data_logs');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('data_logs');
    }
};
