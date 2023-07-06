<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUjianSesiRuangansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ujian_sesi_ruangans', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('ujian_sesi_id');
            $table->string('gedung')->nullable(); //lab tipd atau lab terpadu atau aditorium atau aula perpus
            $table->string('kode_ruangan'); //LAB-01, LAB-02, ini jadi username pangawas, passwordnya random 6 karakter
            $table->string('ruangan'); //lab 1, lab 2
            // $table->unsignedBigInteger('pegawai_id')->nullable();
            $table->string('nama_pengawas')->nullable();
            $table->timestamps();

            $table->foreign('ujian_sesi_id')->references('id')->on('ujian_sesis');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ujian_sesi_ruangans');
    }
}
