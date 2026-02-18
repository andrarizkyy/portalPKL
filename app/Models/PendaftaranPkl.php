<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PendaftaranPkl extends Model
{
    protected $fillable = ['user_id', 'posisi_id', 'sekolah_id', 'jurusan_id', 'cv', 'cover_letter', 'status'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function posisi()
    {
        return $this->belongsTo(Posisi::class);
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