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
        // Ini schema untuk migrate ulang dari awal.
        // Schema::create('ijazah', function (Blueprint $table) {
        //     $table->id('id_ijazah');
        //     $table->bigInteger('mahasiswa_id')->unsigned();
        //     $table->foreign('mahasiswa_id')->references('id_mahasiswa')->on('mahasiswa')->cascadeOnDelete();
        //     $table->string('path_foto_kuitansi');
        //     $table->string('path_file_ijazah');
        //     $table->string('email');
        //     $table->string('no_hp');
        //     $table->enum('status', ['unchecked', 'checked', 'rejected']);
        //     $table->text('komentar')->nullable();
        //     $table->timestamps();
        // });

        // Schema untuk menambah kolom baru
        Schema::table('ijazah', function (Blueprint $table) {
            $table->tinyInteger('file_status')->default(1)->comment('1 = Aktif, 0 = Tidak Aktif')->after('komentar');
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
