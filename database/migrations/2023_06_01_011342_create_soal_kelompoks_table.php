<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSoalKelompoksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('soal_kelompoks', function (Blueprint $table) {
            $table->id();
            $table->string('kelompok_soal_nama');
            $table->text('keterangan');
            $table->boolean('is_aktif')->default(true);
            // $table->unsignedBigInteger('upload_by');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('soal_kelompoks');
    }
}
