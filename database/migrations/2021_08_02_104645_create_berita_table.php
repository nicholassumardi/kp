<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBeritaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('berita', function (Blueprint $table) {
            $table->id('id_berita');
            $table->bigInteger('admin_id')->unsigned();
            $table->foreign('admin_id')->references('id_admin')->on('admin')->cascadeOnDelete();
            $table->string('judul_berita');
            $table->string('tanggal_berita');
            $table->string('path_foto_berita')->nullable();
            $table->string('isi_berita');
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
        Schema::dropIfExists('berita');
    }
}
