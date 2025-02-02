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
        Schema::create('log_peminjamans', function (Blueprint $table) {
            $table->increments('id_peminjaman');
            $table->unsignedInteger('siswa_id');
            $table->enum('status_peminjaman', ['dipinjam', 'dikembalikan', 'rusak']);
            $table->timestamp('tanggal_pinjam')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->time('waktu_kembali');
            $table->unsignedInteger('approved_by');
            $table->foreign('siswa_id')->references('id_siswa')->on('siswas')->onDelete('cascade')->onUpdate('cascade')->index('idx_siswa_peminjaman');
            $table->foreign('approved_by')->references('id_guru')->on('gurus')->onDelete('cascade')->onUpdate('cascade')->index('idx_guru_peminjaman');
        });
        Schema::create('detail_peminjamans', function (Blueprint $table) {
            $table->increments('id_detail');
            $table->unsignedInteger('peminjaman_id');
            $table->unsignedInteger('barang_id');
            $table->unsignedInteger('unit_id')->nullable();
            $table->integer('jumlah_barang');
            $table->text('deskripsi_peminjaman');
            $table->foreign('peminjaman_id')->references('id_peminjaman')->on('log_peminjamans')->onDelete('cascade')->onUpdate('cascade')->index('idx_peminjaman_detail_peminjaman');
            $table->foreign('barang_id')->references('id_barang')->on('barangs')->onDelete('cascade')->onUpdate('cascade')->index('idx_barang_detail_peminjaman');
            $table->foreign('unit_id')->references('id_unit')->on('unit_barangs')->onDelete('cascade')->onUpdate('cascade')->index('idx_unit_detail_peminjaman');

        });
        Schema::create('peminjaman_kbm', function (Blueprint $table) {
            $table->unsignedInteger('peminjaman_id');
            $table->unsignedInteger('kelas_id');
            $table->unsignedInteger('mapel_id');
            $table->foreign('peminjaman_id')->references('id_peminjaman')->on('log_peminjamans')->onDelete('cascade')->onUpdate('cascade')->index('idx_peminjaman_kbm');
            $table->foreign('kelas_id')->references('id_kelas')->on('kelass')->onDelete('cascade')->onUpdate('cascade')->index('idx_kelas_kbm');
            $table->foreign('mapel_id')->references('id_mapel')->on('mapels')->onDelete('cascade')->onUpdate('cascade')->index('idx_mapel_kbm');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('peminjaman');
        Schema::dropIfExists('detail_peminjamans');
        Schema::dropIfExists('peminjaman');
    }
};
