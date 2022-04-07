<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTranskripNilaiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transkrip_nilai', function (Blueprint $table) {
            $table->id('id_transkrip_nilai');
            $table->bigInteger('mahasiswa_id')->unsigned();
            $table->foreign('mahasiswa_id')->references('id_mahasiswa')->on('mahasiswa')->cascadeOnDelete();
            $table->string('path_foto_kuitansi');
            $table->string('path_file_transkrip_nilai');
            $table->string('email');
            $table->string('no_hp');
            $table->enum('status', ['unchecked', 'checked']);
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
        Schema::dropIfExists('transkrip_nilai');
    }
}
