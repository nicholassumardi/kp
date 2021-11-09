<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUmumTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('umum', function (Blueprint $table) {
            $table->id('id_umum');
            $table->string('nama');
            $table->integer('umur')->nullable();
            $table->string('alamat')->nullable();
            $table->string('kota', 100)->nullable();
            $table->string('negara', 100)->nullable();
            $table->string('path_foto')->default('images/profile/umum/default.png');
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id_user')->on('user');
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
        Schema::dropIfExists('umum');
    }
}
