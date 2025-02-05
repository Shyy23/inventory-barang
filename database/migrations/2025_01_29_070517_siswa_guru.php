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
        Schema::create('students', function (Blueprint $table) {
            $table->increments('student_id');
            $table->unsignedInteger('user_id');
            $table->string('name', 250);
            $table->string('nisn', 25)->unique();
            $table->enum('gender', ['M', 'F']);
            $table->unsignedInteger('class_id');
            $table->string('phone_number', 100);
            $table->text('address');
            $table->foreign('user_id')->references('user_id')->on('users')->onDelete('cascade')->onUpdate('cascade')->index('idx_user_student');
            $table->foreign('class_id')->references('class_id')->on('classes')->onDelete('cascade')->onUpdate('cascade')->index('idx_class_student');
        });

        Schema::create('teachers', function (Blueprint $table) {
            $table->increments('teacher_id');
            $table->unsignedInteger('user_id');
            $table->string('name', 250);
            $table->string('nip', 25)->unique();
            $table->enum('gender', ['M', 'F']);
            $table->enum('teacher_role', ['homeroom_teacher', 'subject_teacher', 'others']);
            $table->string('phone_number', 100);
            $table->text('address');
            $table->foreign('user_id')->references('user_id')->on('users')->onDelete('cascade')->onUpdate('cascade')->index('idx_user_teacher');
        });

        Schema::create('teacher_details', function (Blueprint $table) {
            $table->increments('teacher_detail_id');
            $table->unsignedInteger('teacher_id');
            $table->unsignedInteger('class_id');
            $table->unsignedInteger('subject_id');
            $table->string('academic_year', 10);
            $table->foreign('teacher_id')->references('teacher_id')->on('teachers')->onDelete('cascade')->onUpdate('cascade')->index('idx_teacher_detail');
            $table->foreign('class_id')->references('class_id')->on('classes')->onDelete('cascade')->onUpdate('cascade')->index('idx_class_detail');
            $table->foreign('subject_id')->references('subject_id')->on('subjects')->onDelete('cascade')->onUpdate('cascade')->index('idx_subject_detail');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('teacher_details');
        Schema::dropIfExists('teachers');
        Schema::dropIfExists('students');
    }
};
