<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePesertaSoalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('peserta_soals', function (Blueprint $table) { //ini digenerate ketika peserta klik mulai ujian
            $table->id();
            $table->unsignedBigInteger('ujian_sesi_peserta_id');
            $table->unsignedBigInteger('soal_id');
            $table->integer('urutan'); //urutan soal
            $table->boolean('is_last_urutan_bagian')->default(false);

            $table->timestamps();
            $table->foreign('ujian_sesi_peserta_id')->references('id')->on('ujian_sesi_pesertas')->onDelete('cascade');
            $table->foreign('soal_id')->references('id')->on('soals')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('peserta_soals');
    }
}
