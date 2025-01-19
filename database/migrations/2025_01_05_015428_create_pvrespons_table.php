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
        Schema::create('pvrespons', function (Blueprint $table) {
            $table->id();
            $table->string('ref')->nullable();
            $table->string('va')->nullable();
            $table->string('nama')->nullable();
            $table->string('teller')->nullable();
            $table->string('transcode')->nullable();
            $table->string('seq')->nullable();
            $table->string('tgl')->nullable();
            $table->string('jam')->nullable();
            $table->string('amount')->nullable();
            $table->string('revflag')->nullable();
            $table->string('revseq')->nullable();
            $table->string('revjam')->nullable();
            $table->string('tagihan')->nullable();
            $table->string('terbayar')->nullable();
            $table->string('idtagihan')->nullable();
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
        Schema::dropIfExists('pvrespons');
    }
};
