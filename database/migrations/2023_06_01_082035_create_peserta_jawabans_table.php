<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePesertaJawabansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('peserta_jawabans', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('peserta_soal_id'); //soal beserta siapa yg menjawab
            $table->unsignedBigInteger('soal_opsi_id'); // ini jawaban yg dipilih

            $table->timestamps();
            $table->foreign('peserta_soal_id')->references('id')->on('peserta_soals')->onDelete('cascade');
            $table->foreign('soal_opsi_id')->references('id')->on('soal_opsis')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('peserta_jawabans');
    }
}
