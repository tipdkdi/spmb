<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePmbUjiansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pmb_ujians', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pmb_id');
            $table->unsignedBigInteger('ujian_id');

            $table->timestamps();
            $table->foreign('pmb_id')->references('id')->on('pmbs');
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
        Schema::dropIfExists('pmb_ujians');
    }
}
