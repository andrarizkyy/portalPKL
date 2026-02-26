<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class SiswaProfile extends Model
{
    use HasUuids;

    protected $table = 'siswa_profiles';

    protected $fillable = ['user_id', 'sekolah_id', 'jurusan_id', 'nis', 'phone', 'gender', 'address'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function sekolah()
    {
        return $this->belongsTo(Sekolah::class);
    }
    public function jurusan()
    {
        return $this->belongsTo(Jurusan::class);
    }
}