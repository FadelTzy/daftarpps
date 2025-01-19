<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class konsultasiSiswa extends Model
{
    use HasFactory;
    public function mPesan()
    {
        return $this->hasMany(pesan::class, 'id','id_konsultasi');
    }
    public function oSiswa()
    {
        return $this->hasOne(User::class, 'id','id_siswa');
    }
    public function oGuru()
    {
        return $this->hasOne(User::class, 'id','id_guru');
    }
    protected $guarded = [];
}
