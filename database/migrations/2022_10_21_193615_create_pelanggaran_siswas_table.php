<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pelanggaran_siswas', function (Blueprint $table) {
            $table->id();
            $table->text('id_siswa')->nullable();
            $table->text('id_pelanggaran')->nullable();
            $table->text('tindaklanjut')->nullable();
            $table->text('poinsisa')->nullable();
            $table->text('poinpelanggaran')->nullable();
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
        Schema::dropIfExists('pelanggaran_siswas');
    }
};
