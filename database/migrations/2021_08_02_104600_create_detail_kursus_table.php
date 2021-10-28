<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetailKursusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detail_kursus', function (Blueprint $table) {
            // $table->bigInteger('mahasiswa_id')->unsigned();
            // $table->foreign('mahasiswa_id')->references('id_mahasiswa')->on('mahasiswa')->cascadeOnDelete();
            // $table->bigInteger('kursus_id')->unsigned();
            // $table->foreign('kursus_id')->references('id_kursus')->on('kursus')->cascadeOnDelete();
            // $table->bigInteger('jadwal_id')->unsigned();
            // $table->foreign('jadwal_id')->references('id_jadwal')->on('jadwal')->cascadeOnDelete();
            // $table->timestamps();

            $table->bigInteger('mahasiswa_id')->unsigned();
            $table->foreign('mahasiswa_id')->references('id_mahasiswa')->on('mahasiswa')->cascadeOnDelete();
            $table->bigInteger('kursus_id')->unsigned();
            $table->foreign('kursus_id')->references('id_kursus')->on('kursus')->cascadeOnDelete();
            // $table->bigInteger('jadwal_id')->unsigned();
            // $table->foreign('jadwal_id')->references('id_jadwal')->on('jadwal')->cascadeOnDelete();
            $table->integer('no_kartu_mahasiswa');
            $table->string('path_foto_kuitansi');
            $table->string('path_foto_mahasiswa');
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
        Schema::dropIfExists('detail_kursus');
    }
}
