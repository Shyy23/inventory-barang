<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;


return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('loans', function (Blueprint $table) {
            $table->increments('loan_id');
            $table->string('nisn', 25);
            $table->enum('loan_status', ['borrowed', 'returned', 'pending', 'rejected'])->default('pending');
            $table->enum('loan_type', ['individu', 'kelas']);
            $table->boolean('is_approved')->nullable()->default(null);
            $table->timestamp('loan_date')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('due_date')->nullable();
            $table->string('approved_by', 25)->nullable();
            $table->timestamps();
            $table->foreign('nisn')->references('nisn')->on('students')->onDelete('cascade')->onUpdate('cascade')->index('idx_student_loan');
            $table->foreign('approved_by')->references('nip')->on('teachers')->onDelete('cascade')->onUpdate('cascade')->index('idx_teacher_loan');
        });

        Schema::create('loan_details', function (Blueprint $table) {
            $table->increments('loan_detail_id');
            $table->unsignedInteger('loan_id');
            $table->unsignedInteger('item_id');
            $table->unsignedInteger('unit_id')->nullable();
            $table->integer('item_quantity');
            $table->text('loan_description');
            $table->foreign('loan_id')->references('loan_id')->on('loans')->onDelete('cascade')->onUpdate('cascade')->index('idx_loan_detail');
            $table->foreign('item_id')->references('item_id')->on('items')->onDelete('cascade')->onUpdate('cascade')->index('idx_item_detail');
            $table->foreign('unit_id')->references('unit_id')->on('item_units')->onDelete('cascade')->onUpdate('cascade')->index('idx_unit_detail');
        });

        Schema::create('class_loans', function (Blueprint $table) {
            $table->increments('class_loan_id');
            $table->unsignedInteger('loan_id');
            $table->unsignedInteger('class_id');
            $table->unsignedInteger('subject_id');
            $table->foreign('loan_id')->references('loan_id')->on('loans')->onDelete('cascade')->onUpdate('cascade')->index('idx_loan_class');
            $table->foreign('class_id')->references('class_id')->on('classes')->onDelete('cascade')->onUpdate('cascade')->index('idx_class_loan');
            $table->foreign('subject_id')->references('subject_id')->on('subjects')->onDelete('cascade')->onUpdate('cascade')->index('idx_subject_loan');
        });

        Schema::create('loan_returns', function(Blueprint $table){
            $table->increments('loan_return_id');
            $table->unsignedInteger('loan_id');
            $table->timestamp('returned_at');
            $table->decimal('fine_amount', 10, 2)->default(0);
            $table->text('notes')->nullable();
            $table->foreign('loan_id')->references('loan_id')->on('loans')->onDelete('cascade')->onUpdate('cascade')->index('idx_loan_loan_return');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('class_loans'); 
        Schema::dropIfExists('loan_details');      
        Schema::dropIfExists('loan_returns');
        Schema::dropIfExists('loans');

    }
};
