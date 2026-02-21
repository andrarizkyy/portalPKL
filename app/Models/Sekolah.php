<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sekolah extends Model
{
    protected $table = 'sekolah';

    protected $fillable = ['name', 'address', 'phone', 'email', 'logo', 'website_url'];

    public function jurusans()
    {
        return $this->hasMany(Jurusan::class);
    }
    public function siswaProfiles()
    {
        return $this->hasMany(SiswaProfile::class);
    }
}