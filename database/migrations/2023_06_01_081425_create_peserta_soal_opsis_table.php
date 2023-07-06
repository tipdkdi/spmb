<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePesertaSoalOpsisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('peserta_soal_opsis', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('peserta_soal_id');
            $table->json('opsis_id'); //ini dikasih array saja nanti dipecah untuk dapat id opsinya
            $table->timestamps();
            $table->foreign('peserta_soal_id')->references('id')->on('peserta_soals')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('peserta_soal_opsis');
    }
}
