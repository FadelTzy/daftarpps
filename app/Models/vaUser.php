<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class vaUser extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function oT()
    {
        return $this->hasOne(vaTagihan::class, 'iduser', 'id');
    }
}
