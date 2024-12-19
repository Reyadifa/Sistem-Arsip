<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePeminjamanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
{
    Schema::create('peminjaman', function (Blueprint $table) {
        $table->id(); // Primary key untuk tabel peminjaman
        $table->unsignedBigInteger('arsip_id'); // Foreign key ke tabel arsip
        $table->string('nama_peminjam');
        $table->text('keperluan');
        $table->date('tgl_minjam');
        $table->date('tgl_kembali')->nullable();
        $table->string('status')->default('dipinjam');
        $table->string('file_arsip')->nullable(); // Field baru untuk menyimpan file arsip
        $table->timestamps();
    
        // Foreign key relationship
        $table->foreign('arsip_id')->references('id')->on('arsips')->onDelete('cascade');
    });
}

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('peminjaman');
    }
}