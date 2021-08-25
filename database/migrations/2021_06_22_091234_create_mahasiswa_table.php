<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMahasiswaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mahasiswa', function (Blueprint $table) {
            $table->id('id_mahasiswa');
            $table->string('nama');
            $table->integer('umur')->nullable();
            $table->string('npm', 50)->unique();
            $table->string('alamat')->nullable();
            $table->string('kota', 100)->nullable();
            $table->string('negara', 100)->nullable();
            $table->string('path_foto')->default('images/profile/mahasiswa/default.png');
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
        Schema::dropIfExists('mahasiswa');
    }
}
