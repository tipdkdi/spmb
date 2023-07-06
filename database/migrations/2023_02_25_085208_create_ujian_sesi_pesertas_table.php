<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUjianSesiPesertasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ujian_sesi_pesertas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('ujian_sesi_ruangan_id');
            $table->string('iddata');
            $table->unsignedBigInteger('data_diri_id');
            $table->string('no_test'); //ini jadi username
            $table->string('no_urut'); //nomor komputer, nomor kursi terserahmi
            $table->boolean('is_aktif')->default(false); //sudah diaktifkan sama pengawas
            $table->boolean('is_hadir')->default(true); //untuk absen
            $table->enum('status', [0, 1, 2])->default(0); //untuk cek selesai atau belum

            $table->timestamps();

            $table->foreign('ujian_sesi_ruangan_id')->references('id')->on('ujian_sesi_ruangans');
            $table->foreign('data_diri_id')->references('id')->on('data_diris');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ujian_sesi_pesertas');
    }
}
