<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKursusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kursus', function (Blueprint $table) {
            $table->bigIncrements('id_kursus');
            $table->bigInteger('admin_id')->unsigned();
            $table->foreign('admin_id')->references('id_admin')->on('admin')->cascadeOnDelete();
            $table->string('nama_kursus');
            $table->bigInteger('jadwal_id')->unsigned();
            $table->foreign('jadwal_id')->references('id_jadwal')->on('jadwal')->cascadeOnDelete();
            $table->tinyInteger('status')->default(1)->comment('Untuk penanda status bidan | 1 = Aktif, 0 = Tidak Aktif');
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
        Schema::dropIfExists('kursus');
    }
}