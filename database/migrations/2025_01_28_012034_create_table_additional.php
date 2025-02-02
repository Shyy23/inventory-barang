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
            $table->increments('id_abc');
            $table->string('nama_abc', 25);
        });

        Schema::create('mapels', function (Blueprint $table) {
            $table->increments('id_mapel');
            $table->string('nama_mapel', 100);
        });

        Schema::create('kelass', function (Blueprint $table) {
            $table->increments('id_kelas');
            $table->enum('tingkatan', ['10', '11', '12']);
            $table->enum('jurusan', ['RPL']);
            $table->unsignedInteger('abc_id');
            $table->foreign('abc_id')->references('id_abc')->on('abcs')->onDelete('cascade')->onUpdate('cascade')->index('idx_abc_kelas');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {

        Schema::dropIfExists('kelass');
        Schema::dropIfExists('mapels');
        Schema::dropIfExists('abcs');
    }
};
