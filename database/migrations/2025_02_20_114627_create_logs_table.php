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
        // Migration
Schema::create('logs', function (Blueprint $table) {
    $table->id();
    $table->string('level'); // info, error, warning
    $table->text('message');
    $table->json('context')->nullable(); // data tambahan (JSON)
    $table->string('ip')->nullable();
    $table->unsignedBigInteger('user_id')->nullable();
    $table->timestamps();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('logs');
    }
};
