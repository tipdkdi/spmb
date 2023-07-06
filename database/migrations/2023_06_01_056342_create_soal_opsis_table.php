<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSoalOpsisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('soal_opsis', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('soal_id');
            // $table->integer('opsi_label'); //a,b,c,d,e
            $table->string('opsi_text'); //pilihan jawaban misalnya kucing, kerbau
            $table->boolean('is_jawaban')->default(false);

            $table->timestamps();
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
        Schema::dropIfExists('soal_opsis');
    }
}
