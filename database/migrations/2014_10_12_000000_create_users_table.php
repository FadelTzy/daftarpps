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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('alamat')->nullable();
            $table->string('username')->nullable();
            $table->string('wali')->nullable();
            $table->string('pekerjaan')->nullable();
            $table->string('nowali')->nullable();

            $table->string('status')->nullable();
            $table->string('no')->nullable();
            $table->string('kelas')->nullable();
            $table->string('role')->nullable();
            $table->string('foto')->nullable();
            $table->string('id_guru')->nullable();

            $table->string('poin')->nullable()->default(100);

            $table->string('kode')->nullable()->comment('1 admin 2 siswa 3 guru');
            $table->string('email')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            
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
        Schema::dropIfExists('users');
    }
};
