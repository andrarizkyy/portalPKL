<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class PendaftaranPkl extends Model
{
    use HasUuids;

    protected $table = 'pendaftaran_pkls';

    protected $fillable = [
        'user_id', 'posisi_id', 'sekolah_id', 'jurusan_id',
        'cv', 'cover_letter', 'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function siswaProfile()
    {
        return $this->hasOneThrough(SiswaProfile::class , User::class , 'id', 'user_id', 'user_id', 'id');
    }
    public function posisi()
    {
        return $this->belongsTo(Posisi::class , 'posisi_id');
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