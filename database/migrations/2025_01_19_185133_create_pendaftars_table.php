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
            $table->string('nik')->nullable();
            $table->string('tanggal_lahir')->nullable();
            $table->string('email')->nullable();
            $table->string('status')->nullable();
            $table->string('status_bayar')->nullable()->comment('lunas tidak lunas');

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
