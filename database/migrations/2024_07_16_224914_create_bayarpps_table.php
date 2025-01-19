<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bayarpps', function (Blueprint $table) {
            $table->id();
            $table->string('idppsmhs')->nullable();
            $table->string('va')->nullable();
            $table->string('ref')->nullable();
            $table->string('nama')->nullable();
            $table->string('layanan')->nullable();
            $table->string('kodelayanan')->nullable()->comment('1 baru 2 lanjut');
            $table->string('jenisbayar')->nullable();
            $table->string('kodejenisbayar')->nullable();
            $table->string('nogiro')->nullable();
            $table->integer('tagihan')->nullable();
            $table->integer('totalbayar')->nullable();
            $table->integer('sisa')->nullable();
            $table->integer('noid')->nullable();
            $table->string('flag')->nullable();
            $table->string('angkatan')->nullable();
            $table->string('periode')->nullable();
            $table->string('description')->nullable();
            $table->string('expired')->nullable();
            $table->string('reserve')->nullable();
            $table->string('statusbayar')->nullable()->comment('1 sudah null belum');

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
        Schema::dropIfExists('bayarpps');
    }
};
