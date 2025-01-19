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
        Schema::create('va_tagihans', function (Blueprint $table) {
            $table->id();
            $table->string('nama')->nullable();
            $table->string('iduser')->nullable();

            $table->string('nim')->nullable();
            $table->string('tagihan')->nullable();
            $table->string('tahun_akademik')->nullable();
            $table->string('bank')->nullable();
            $table->string('c_bank')->nullable();
            $table->string('fakultas')->nullable();
            $table->string('c_fak')->nullable();
            $table->string('status')->nullable()->comment('1 sukses 2 gagal');
            $table->string('status_b')->nullable()->comment('1 belum 2 sudah');
            $table->string('no_ref')->nullable();
            $table->string('va')->nullable();
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
        Schema::dropIfExists('va_tagihans');
    }
};
