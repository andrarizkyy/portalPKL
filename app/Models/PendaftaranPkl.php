<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PendaftaranPkl extends Model
{
    protected $table = 'pendaftaran_pkl';

    protected $fillable = [
        'siswa_id', 'position_id', 'sekolah_id', 'jurusan_id',
        'cv', 'cover_letter', 'portfolio_url', 'sertifikat',
        'start_date', 'end_date', 'status', 'apply_date', 'notes',
    ];

    protected function casts(): array
    {
        return [
            'start_date' => 'date',
            'end_date' => 'date',
            'apply_date' => 'date',
        ];
    }

    public function siswa()
    {
        return $this->belongsTo(SiswaProfile::class , 'siswa_id');
    }
    public function user()
    {
        // Convenience: get User via siswa relationship
        return $this->hasOneThrough(User::class , SiswaProfile::class , 'id', 'id', 'siswa_id', 'user_id');
    }
    public function posisi()
    {
        return $this->belongsTo(Posisi::class , 'position_id');
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