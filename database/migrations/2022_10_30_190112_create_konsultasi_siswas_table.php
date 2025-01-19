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
        Schema::create('konsultasi_siswas', function (Blueprint $table) {
            $table->id();
            $table->string('id_siswa')->nullable();
            $table->string('id_guru')->nullable();
            $table->string('judul')->nullable();
            $table->string('status')->nullable()->comment('1 pengajuan 2 sedang 3 selesai');
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
        Schema::dropIfExists('konsultasi_siswas');
    }
};
