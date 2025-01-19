<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pvsemester extends Model
{
    protected $guarded = [];
    use HasFactory;

    public function mS()
    {
        return $this->hasMany(pvgel::class, 'kode_semester', 'kode_semester');
    }
}
