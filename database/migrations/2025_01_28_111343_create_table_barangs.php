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
        Schema::create('kategoris', function (Blueprint $table) {
            $table->increments('id_kategori');
            $table->string('nama_kategori', 255);
        });

        Schema::create('lokasis', function (Blueprint $table) {
            $table->increments('id_lokasi');
            $table->string('nama_lokasi', 255);
        });
        Schema::create('barangs', function (Blueprint $table) {
            $table->increments('id_barang');
            $table->string('nama_barang', 255);
            $table->unsignedInteger('kategori_id');
            $table->unsignedInteger('lokasi_id');
            $table->integer('stok');
            $table->longText('deskripsi');
            $table->string('gambar', 255);
            $table->enum('status', ['tersedia', 'habis']);
            $table->foreign('kategori_id')->references('id_kategori')->on('kategoris')->onDelete('cascade')->onUpdate('cascade')->index('idx_kategori_barang');
            $table->foreign('lokasi_id')->references('id_lokasi')->on('lokasis')->onDelete('cascade')->onUpdate('cascade')->index('idx_lokasi_barang');
        });



        Schema::create('unit_barangs', function (Blueprint $table) {
            $table->increments('id_unit');
            $table->unsignedInteger('barang_id');
            $table->string('nama_unit', 100);
            $table->enum('status_unit', ['tersedia', 'dipinjam', 'rusak']);
            $table->string('gambar_unit', 255);
            $table->foreign('barang_id')->references('id_barang')->on('barangs')->onDelete('cascade')->onUpdate('cascade')->index('idx_barang_unit');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('unit_barangs');
        Schema::dropIfExists('barangs');
        Schema::dropIfExists('kategoris');
        Schema::dropIfExists('lokasis');

    }
};
