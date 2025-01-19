<?php

namespace App\Models;

use App\Imports\vauser;
use App\Models\vaUser as ModelsVaUser;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class vaTagihan extends Model
{
    protected $guarded = [];
    public function oB()
    {
        return $this->hasOne(vaBayar::class, 'id_tagihan','id');
    }
    public function oU()
    {
        return $this->hasOne(ModelsVaUser::class, 'id','iduser');
    }
}
