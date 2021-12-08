<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetailKursusUmumTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detail_kursus_umum', function (Blueprint $table) {
            $table->bigInteger('umum_id')->unsigned();
            $table->foreign('umum_id')->references('id_umum')->on('umum')->cascadeOnDelete();
            $table->bigInteger('kursus_id')->unsigned();
            $table->foreign('kursus_id')->references('id_kursus')->on('kursus')->cascadeOnDelete();
            $table->integer('no_kartu_umum');
            $table->string('path_foto_kuitansi');
            $table->string('path_foto_umum');
            $table->string('path_foto_sertifikat')->nullable();
            $table->tinyInteger('status_verifikasi')->default(0)->comment('Jika 1 maka Sudah terverifikasi || Jika 0 Belum terverifikasi');
            $table->text('komentar')->nullable();
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
        Schema::dropIfExists('detail_kursus_umum');
    }
}
