<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUjianSoalBagiansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ujian_soal_bagians', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('ujian_id');
            $table->unsignedBigInteger('soal_kelompok_id');
            $table->string('bagian_kode');
            $table->string('bagian_nama');
            $table->integer('bagian_urutan');
            $table->string('bagian_keterangan');
            $table->integer('jumlah_soal');
            $table->boolean('is_pilihan_ganda')->default(true);
            $table->integer('jumlah_opsi_pilihan_ganda')->default(4);

            $table->timestamps();
            $table->foreign('ujian_id')->references('id')->on('ujians');
            $table->foreign('soal_kelompok_id')->references('id')->on('soal_kelompoks');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ujian_soal_bagians');
    }
}
