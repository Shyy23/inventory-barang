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
        Schema::create('siswas', function (Blueprint $table) {
            $table->increments('id_siswa');
            $table->unsignedInteger('user_id');
            $table->string('nisn', 25);
            $table->string('nama', 250);
            $table->enum('jenis_kelamin', ['L', 'P']);
            $table->unsignedInteger('kelas_id');
            $table->string('no_telepon', 100);
            $table->text('alamat');
            $table->foreign('user_id')->references('id_user')->on('users')->onDelete('cascade')->onUpdate('cascade')->index('idx_user_siswa');
            $table->foreign('kelas_id')->references('id_kelas')->on('kelass')->onDelete('cascade')->onUpdate('cascade')->index('idx_kelas_siswa');
        });

        Schema::create('gurus', function (Blueprint $table) {
            $table->increments('id_guru');
            $table->unsignedInteger('user_id');
            $table->string('nip', 25);
            $table->string('nama', 250);
            $table->enum('jenis_kelamin', ['L', 'P']);
            $table->enum('role_guru', ['walikelas', 'guru_mapel', 'lainnya']);
            $table->string('no_telepon', 100);
            $table->text('alamat');
            $table->foreign('user_id')->references('id_user')->on('users')->onDelete('cascade')->onUpdate('cascade')->index('idx_user_guru');
        });

        Schema::create('detail_gurus', function (Blueprint $table) {
            $table->unsignedInteger('guru_id');
            $table->unsignedInteger('kelas_id');
            $table->unsignedInteger('mapel_id');
            $table->unsignedInteger('tahun_ajaran');
            $table->foreign('guru_id')->references('id_guru')->on('gurus')->onDelete('cascade')->onUpdate('cascade')->index('idx_guru_detail');
            $table->foreign('kelas_id')->references('id_kelas')->on('kelass')->onDelete('cascade')->onUpdate('cascade')->index('idx_kelas_detail');
            $table->foreign('mapel_id')->references('id_mapel')->on('mapels')->onDelete('cascade')->onUpdate('cascade')->index('idx_mapel_detail');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('siswas');
        Schema::dropIfExists('gurus');
        Schema::dropIfExists('detail_gurus');

    }
};
