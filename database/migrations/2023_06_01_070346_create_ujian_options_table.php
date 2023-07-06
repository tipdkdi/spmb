<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUjianOptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ujian_options', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('ujian_id');
            // $table->string('bagian_kode');
            // $table->string('bagian_nama');
            // $table->integer('bagian_urutan');
            // $table->string('bagian_keterangan');
            // $table->integer('jumlah_soal');
            // $table->boolean('is_pilihan_ganda')->default(true);
            // $table->integer('jumlah_opsi_pilihan_ganda')->default(4);
            $table->timestamps();
            $table->foreign('ujian_id')->references('id')->on('ujians');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ujian_options');
    }
}
