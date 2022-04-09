<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTranskripNilaiUmumTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transkrip_nilai_umum', function (Blueprint $table) {
            $table->id('id_transkrip_nilai_umum');
            $table->bigInteger('umum_id')->unsigned();
            $table->foreign('umum_id')->references('id_umum')->on('umum')->cascadeOnDelete();
            $table->string('path_foto_kuitansi');
            $table->string('path_file_transkrip_nilai');
            $table->string('email');
            $table->string('no_hp');
            $table->enum('status', ['unchecked', 'checked', 'rejected']);
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
        Schema::dropIfExists('transkrip_nilai_umum');
    }
}
