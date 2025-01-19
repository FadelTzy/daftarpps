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
        Schema::create('va_btns', function (Blueprint $table) {
            $table->id();
            $table->string('ref')->nullable();
            $table->string('va')->nullable();
            $table->string('nama')->nullable();
            $table->string('layanan')->nullable();
            $table->string('kodelayanan')->nullable();
            $table->string('jenisbayar')->nullable();
            $table->string('kodejenisbyr')->nullable();
            $table->string('noid')->nullable();
            $table->string('tagihan')->nullable();
            $table->string('flag')->nullable();
            $table->string('“reserve”')->nullable();
            $table->string('“angkatan”')->nullable();
            $table->string('“expired”')->nullable();
            $table->string('“description”')->nullable();
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
        Schema::dropIfExists('va_btns');
    }
};
