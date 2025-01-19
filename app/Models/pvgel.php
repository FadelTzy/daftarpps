<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pvgel extends Model
{
    protected $guarded = [];
    use HasFactory;
    public function mT()
    {
        return $this->hasMany(pvtagihan::class, 'gel', 'kodegel');
    }
    public function oS()
    {
        return $this->hasOne(pvsemester::class, 'kode_semester', 'kode_semester');
    }
}
