<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePmbAkunsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pmb_akuns', function (Blueprint $table) { //ini akun hanya untuk ujian pmb saja
            $table->id();
            $table->unsignedBigInteger('ujian_sesi_id');
            $table->unsignedBigInteger('data_diri_id');
            $table->string('username'); //generate
            $table->string('password'); //generate
            $table->boolean('is_login')->default(false); //batasi supaya login hanya 1 kali saja
            $table->unsignedBigInteger('user_role_id');

            $table->timestamps();
            $table->foreign('user_role_id')->references('id')->on('user_roles');
            $table->foreign('ujian_sesi_id')->references('id')->on('ujian_sesis');
            // $table->foreign('data_diri_id')->references('id')->on('data_diris');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pmb_akuns');
    }
}
