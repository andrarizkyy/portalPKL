<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sekolah extends Model
{
    protected $fillable = ['nama', 'alamat', 'telepon'];

    public function jurusans()
    {
        return $this->hasMany(Jurusan::class);
    }
    public function siswaProfiles()
    {
        return $this->hasMany(SiswaProfile::class);
    }
}