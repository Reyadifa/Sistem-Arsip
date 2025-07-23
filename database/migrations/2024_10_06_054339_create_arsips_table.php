<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArsipsTable extends Migration
{
    public function up()
    {
        Schema::create('arsips', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('id_kategori')->nullable();
            $table->foreign('id_kategori')->references('id_kategori')->on('kategoris')->onDelete('cascade');

            $table->unsignedBigInteger('usaha_id');
            $table->foreign('usaha_id')->references('id')->on('usahas')->onDelete('cascade');

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
