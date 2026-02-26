<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class Sekolah extends Model
{
    use HasUuids;

    protected $table = 'sekolahs';

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