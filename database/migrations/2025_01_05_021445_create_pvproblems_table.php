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
        Schema::create('pvproblems', function (Blueprint $table) {
            $table->id();
            $table->string('idyangsama')->nullable();  // Tambahkan index
            $table->string('nama')->nullable()->index();  // Tambahkan index
            $table->string('nik', 20)->nullable()->unique();  // NIK biasanya unik dan tidak integer
            $table->string('nim', 20)->nullable()->unique();  // NIM juga bisa unik
            $table->string('nodaftar', 20)->nullable()->index();  // Tambahkan index untuk pencarian cepat
            $table->string('prodi', 100)->nullable();
            $table->string('fakultas', 100)->nullable();
            $table->string('jenjang', 10)->nullable();
            $table->string('jalur_masuk', 50)->nullable();
            $table->string('angkatan', 10)->nullable();

            $table->tinyInteger('status')->nullable()->comment('1 aktif, 2 tidak')->index();  // tinyInteger untuk efisiensi
            $table->tinyInteger('jenis')->nullable()->comment('1 baru, 2 lanjut')->index();
            $table->tinyInteger('defer')->nullable()->comment('1 iya, 2 tidak');
            $table->string('va', 30)->nullable()->unique();  // VA sebaiknya string dan unik

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
        Schema::dropIfExists('pvproblems');
    }
};
