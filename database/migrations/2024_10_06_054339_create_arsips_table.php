<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArsipsTable extends Migration
{
    public function up()
    {
        Schema::create('arsips', function (Blueprint $table) {
            $table->id(); // ID Arsip
            $table->unsignedBigInteger('id_kategori'); // Foreign key for kategori
            $table->foreign('id_kategori')->references('id_kategori')->on('kategoris')->onDelete('cascade');
            $table->string('nama_usaha');
            $table->string('alamat_usaha');
            $table->string('nama_pemilik');
            $table->string('alamat_pemilik');
            $table->string('npwp');
            $table->string('bulan');
            $table->integer('tahun');
            $table->string('file_path')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('arsips');
    }
}