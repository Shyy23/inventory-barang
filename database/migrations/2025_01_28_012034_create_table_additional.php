<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('abcs', function (Blueprint $table) {
            $table->increments('abc_id');
            $table->string('abc_name', 25);
        });

        Schema::create('subjects', function (Blueprint $table) {
            $table->increments('subject_id');
            $table->string('subject_name', 100);
        });
        Schema::create('locations', function (Blueprint $table) {
            $table->increments('location_id');
            $table->string('location_name', 255);
            $table->enum('type', ['item', 'class']);
        });
        Schema::create('classes', function (Blueprint $table) {
            $table->increments('class_id');
            $table->enum('level', ['10', '11', '12']);
            $table->enum('major', ['RPL', 'ORACLE', 'GAMELAB'])->default('RPL');
            $table->unsignedInteger('abc_id');
            $table->unsignedInteger('location_id');
            $table->foreign('abc_id')->references('abc_id')->on('abcs')->onDelete('cascade')->onUpdate('cascade')->index('idx_abc_class');
            $table->foreign('location_id')->references('location_id')->on('locations')->onDelete('cascade')->onUpdate('cascade')->index('idx_location_class');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('classes');
        Schema::dropIfExists('locations');
        Schema::dropIfExists('subjects');
        Schema::dropIfExists('abcs');
    }
};
