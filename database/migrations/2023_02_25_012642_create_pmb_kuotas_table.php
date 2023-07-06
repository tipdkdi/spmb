<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePmbKuotasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pmb_kuotas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pmb_id');
            $table->unsignedBigInteger('organisasi_id');
            $table->integer('kuota');

            $table->timestamps();
            $table->foreign('pmb_id')->references('id')->on('pmbs');
            // $table->foreign('organisasi_id')->references('id')->on('organisasis');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pmb_kuotas');
    }
}
