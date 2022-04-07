<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIjazahTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ijazah', function (Blueprint $table) {
            $table->id('id_ijazah');
            $table->bigInteger('mahasiswa_id')->unsigned();
            $table->foreign('mahasiswa_id')->references('id_mahasiswa')->on('mahasiswa')->cascadeOnDelete();
            $table->string('path_foto_kuitansi');
            $table->string('path_file_ijazah');
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
        Schema::dropIfExists('ijazah');
    }
}
