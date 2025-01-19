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
        Schema::create('va_banks', function (Blueprint $table) {
            $table->id();
            $table->string('bank')->nullable();
            $table->string('c_bank')->nullable();
            $table->string('c_fak')->nullable();
            $table->string('fak')->nullable();
            $table->text('ket')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('va_banks');
    }
};
