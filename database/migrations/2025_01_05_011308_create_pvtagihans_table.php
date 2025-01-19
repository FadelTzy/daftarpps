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
        Schema::create('pvtagihans', function (Blueprint $table) {
            $table->id();
            $table->integer('idmhs')->index();  // Index untuk mempercepat pencarian berdasarkan mahasiswa
            $table->string('nama')->nullable()->index();  // Index untuk pencarian berdasarkan nama
            $table->string('nik', 20)->nullable()->unique();  // NIK biasanya unik
            $table->string('nim', 20)->nullable()->unique();  // NIM juga unik
            $table->string('nodaftar', 20)->nullable()->index();  // Index untuk pencarian cepat
            $table->string('va', 30)->nullable();  // Virtual account bisa panjang, tambahkan panjang maksimum
            $table->string('ref', 30)->nullable();  // Referensi bisa panjang
            $table->string('layanan', 50)->nullable();
            $table->string('kodelayanan', 10)->nullable()->comment('Kode layanan (1 baru, 2 lanjut)');
            $table->string('jenisbayar', 50)->nullable();
            $table->string('kodejenisbayar', 10)->nullable();
            $table->string('nogiro', 30)->nullable();
            $table->integer('tagihan')->nullable();  // Gunakan integer untuk angka besar
            $table->integer('totalbayar')->nullable();
            $table->integer('sisa')->nullable();
            $table->integer('noid')->nullable();
            $table->string('flag', 1)->nullable()->comment('F Full P Partial');  // Batasi panjang flag
            $table->string('angkatan', 10)->nullable();
            $table->string('periode', 10)->nullable();
            $table->string('gel', 10)->nullable();
            $table->string('description', 60)->nullable();  // Deskripsi bisa panjang, gunakan text
            $table->date('expired')->nullable();  // Gunakan date untuk tanggal kadaluarsa
            $table->string('reserve', 30)->nullable();
            $table->tinyInteger('statustagihan')->nullable()->comment('1 dibuat, 2 live 3 selesai');
            $table->tinyInteger('statusbayar')->nullable()->comment('1 lunas, 0 belum');
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
        Schema::dropIfExists('pvtagihans');
    }
};
