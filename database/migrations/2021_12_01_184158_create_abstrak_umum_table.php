<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAbstrakUmumTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Ini schema untuk migrate ulang dari awal.
        // Schema::create('abstrak_umum', function (Blueprint $table) {
        //     $table->id('id_abstrak_umum');
        //     $table->bigInteger('umum_id')->unsigned();
        //     $table->foreign('umum_id')->references('id_umum')->on('umum')->cascadeOnDelete();
        //     $table->string('path_foto_kuitansi');
        //     $table->string('path_file_abstrak_umum');
        //     $table->string('path_file_abstrak_admin_word')->nullable();
        //     $table->string('path_file_abstrak_admin_pdf')->nullable();
        //     $table->string('email');
        //     $table->string('no_hp');
        //     $table->enum('status', ['unverified', 'pending','verified', 'rejected']);
        //     $table->text('komentar')->nullable();
        //     $table->timestamps();
        // });

        // Schema untuk menambah kolom baru
        Schema::table('abstrak_umum', function (Blueprint $table) {
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
        Schema::dropIfExists('abstrak_umum');
    }
}
