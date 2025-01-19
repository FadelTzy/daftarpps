<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pesan extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function oUser()
    {
        return $this->hasOne(User::class, 'id', 'id_user');
    }
}
