<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SiswaProfile extends Model
{
    protected $table = 'siswa';

    protected $fillable = ['user_id', 'sekolah_id', 'jurusan_id', 'nis', 'phone', 'gender', 'address', 'kelas'];

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