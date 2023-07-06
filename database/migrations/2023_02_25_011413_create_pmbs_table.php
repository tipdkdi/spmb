<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePmbsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pmbs', function (Blueprint $table) {
            $table->id();
            $table->string('pmb_nama', 200);
            $table->string('tahun_akademik');
            // $table->unsignedBigInteger('tahun_akademik_id');
            $table->integer('biaya_pendaftaran');
            $table->date('daftar_mulai');
            $table->date('daftar_selesai');
            $table->enum('jenis_ujian', ['online', 'offline']);
            $table->integer('ruang_per_sesi');
            $table->integer('peserta_per_ruang');
            $table->boolean('is_publish');

            $table->timestamps();
            // $table->foreign('tahun_akademik_id')->references('id')->on('master_tahun_akademiks');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pmbs');
    }
}
