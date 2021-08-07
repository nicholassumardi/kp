<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdminTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admin', function (Blueprint $table) {
            $table->id('id_admin');
            $table->string('nama');
            $table->integer('umur');
            $table->string('alamat');
            $table->string('kota', 100);
            $table->string('negara', 100);
            $table->string('path_foto')->default('default.jpg');
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id_user')->on('user');
            //$table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('admin');
    }
}