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
        Schema::create('pelanggarans', function (Blueprint $table) {
            $table->id();
            $table->string('pelanggaran')->nullable();
            $table->string('poin')->nullable();
            $table->text('penilai')->nullable();
            $table->text('tindaklanjut')->nullable();
            $table->text('level')->nullable()->comment('1 ringan 2 sedang 3 berat');

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
        Schema::dropIfExists('pelanggarans');
    }
};
