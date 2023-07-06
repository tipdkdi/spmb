<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePmbPendaftarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pmb_pendaftars', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pmb_id');
            $table->unsignedBigInteger('data_diri_id');
            $table->string('iddata');
            $table->string('nisn');
            $table->timestamps();

            $table->foreign('pmb_id')->references('id')->on('pmbs');
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
        Schema::dropIfExists('pmb_pendaftars');
    }
}
