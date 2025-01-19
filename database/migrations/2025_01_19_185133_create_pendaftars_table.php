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
        Schema::create('pendaftars', function (Blueprint $table) {
            $table->id();
            $table->string('kap')->unique();
            $table->string('nama_lengkap')->nullable();
            $table->string('no_hp')->nullable();
            $table->string('jalur')->nullable();
            $table->string('tempat_lahir')->nullable();
            $table->string('kode_prodi')->nullable();
            $table->string('prodi')->nullable();
            $table->string('status_ujian')->nullable()->comment('lulus tidak lulus');

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
        Schema::dropIfExists('pendaftars');
    }
};
