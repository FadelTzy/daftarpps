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
        Schema::create('daftarmhs', function (Blueprint $table) {
            $table->id();
            $table->string('no_daftar')->nullable();
            $table->string('nim')->unique();
            $table->string('jenis')->nullable()->comment('1 baru masuk 2 lanjut');
            $table->string('nama')->nullable();
            $table->string('fakultas')->nullable();
            $table->string('prodi')->nullable();
            $table->string('jenjang')->nullable();
            $table->string('jalur_masuk')->nullable();
            $table->string('angkatan')->nullable();
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
        Schema::dropIfExists('daftarmhs');
    }
};
