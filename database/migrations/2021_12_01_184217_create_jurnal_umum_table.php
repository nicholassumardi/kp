<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJurnalUmumTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jurnal_umum', function (Blueprint $table) {
            $table->id('id_jurnal_umum');
            $table->bigInteger('umum_id')->unsigned();
            $table->foreign('umum_id')->references('id_umum')->on('umum')->cascadeOnDelete();
            $table->string('path_foto_kuitansi');
            $table->string('path_file_jurnal_umum');
            $table->string('path_file_jurnal_admin_word')->nullable();
            $table->string('path_file_jurnal_admin_pdf')->nullable();
            $table->integer('jumlah_halaman_jurnal');
            $table->string('email');
            $table->string('no_hp');
            $table->enum('status', ['unverified', 'pending','verified', 'rejected']);
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
        Schema::dropIfExists('jurnal_umum');
    }
}
