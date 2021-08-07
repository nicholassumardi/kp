<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBuktiPembayaranTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bukti_pembayaran', function (Blueprint $table) {
            $table->bigIncrements('id_bukti_pembayaran');
            $table->bigInteger('mahasiswa_id')->unsigned();
            $table->foreign('mahasiswa_id')->references('id_mahasiswa')->on('mahasiswa')->cascadeOnDelete();
            $table->bigInteger('kursus_id')->unsigned();
            $table->foreign('kursus_id')->references('id_kursus')->on('kursus')->cascadeOnDelete();
            // ditambah untuk foto
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
        Schema::dropIfExists('bukti_pembayaran');
    }
}
