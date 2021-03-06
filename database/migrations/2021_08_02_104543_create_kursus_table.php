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
            $table->id('id_kursus');
            $table->bigInteger('admin_id')->unsigned();
            $table->foreign('admin_id')->references('id_admin')->on('admin')->cascadeOnDelete();
            $table->enum('tipe_kursus', ['mahasiswa', 'umum', 'mahasiswa dan umum']);
            $table->string('nama_kursus');
            $table->text('deskripsi')->nullable();
            $table->tinyInteger('status')->default(1)->comment('1 = Aktif, 0 = Tidak Aktif');
            $table->tinyInteger('sertifikat')->default(1)->comment('1 = Ya, 0 = Tidak');
            $table->integer('partisipan_saat_ini')->default(0);
            $table->integer('batas_partisipan');
            $table->string('group_link');
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
