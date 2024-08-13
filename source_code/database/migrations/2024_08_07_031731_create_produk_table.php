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
        Schema::create('produk', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('tipe_barang');
            $table->integer('stok');
            $table->date('masa_berlaku_produk');
            $table->string('merk');
            $table->string('no_produk_penyedia');
            $table->string('unit_pengukuran');
            $table->enum('jenis_produk', ['PDN', 'Impor']);
            $table->integer('kode_kbli');
            $table->decimal('nilai_tkdn', 8, 2)->nullable();
            $table->string('no_sni')->nullable();
            $table->string('asal_negara');
            $table->string('garansi_produk')->nullable();
            $table->enum('sni', ['ya', 'tidak']);
            $table->string('uji_fungsi')->nullable();
            $table->enum('memiliki_svlk', ['ya', 'tidak']);
            $table->string('jenis_alat');
            $table->string('fungsi');
            $table->longText('spesifikasi_produk');
            $table->boolean('ramah_lingkungan')->default(false);
            $table->enum('status', ['publish', 'arsip'])->default('arsip'); 
            $table->decimal('harga_diskon', 15, 2)->nullable();
            $table->decimal('harga_tayang', 15, 2);
            $table->timestamps();


            $table->foreignId('komoditas_id')->constrained('komoditas');
            $table->foreignId('sub_kategori_id')->constrained('sub_kategori');
            $table->foreignId('kategori_id')->constrained('kategori');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('produk');
    }
};
