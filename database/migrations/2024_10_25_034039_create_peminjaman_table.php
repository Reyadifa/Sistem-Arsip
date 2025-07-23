<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePeminjamanTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('peminjaman', function (Blueprint $table) {
            $table->id(); // Primary key

            // Foreign key ke arsips
            $table->unsignedBigInteger('arsip_id');
            $table->foreign('arsip_id')->references('id')->on('arsips')->onDelete('cascade');

            // (Opsional) Foreign key ke usahas (jika ingin langsung simpan usaha_id juga)
            $table->unsignedBigInteger('usaha_id');
            $table->foreign('usaha_id')->references('id')->on('usahas')->onDelete('cascade');

            // Informasi peminjam
            $table->string('nama_peminjam');
            $table->string('nohp');
            $table->text('keperluan');
            $table->date('tgl_minjam');
            $table->date('tgl_kembali')->nullable();

            // Dokumen pendukung
            $table->string('surat_kuasa')->nullable(); // File surat kuasa (opsional)
            $table->string('file_arsip')->nullable();  // Scan atau file arsip tambahan (opsional)

            // Status peminjaman
            $table->string('status')->default('dipinjam'); // dipinjam, dikembalikan, dll

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('peminjaman');
    }
}
