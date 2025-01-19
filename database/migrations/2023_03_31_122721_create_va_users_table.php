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
        Schema::create('va_users', function (Blueprint $table) {
            $table->id();
            $table->string('nama')->nullable();
            $table->string('nim')->nullable();
            $table->string('fak')->nullable();
            $table->string('c_fak')->nullable();
            $table->string('prodi')->nullable();
            $table->string('c_prodi')->nullable();
            $table->string('jur')->nullable();
            $table->string('c_jur')->nullable();
            $table->string('tagihan')->nullable();
            $table->string('angkatan')->nullable();
            $table->string('status_b')->nullable();
            $table->string('jk')->nullable();
            $table->string('tahun')->nullable();
            $table->string('tglakhir')->nullable();
            $table->string('jenis')->nullable();

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
        Schema::dropIfExists('va_users');
    }
};
