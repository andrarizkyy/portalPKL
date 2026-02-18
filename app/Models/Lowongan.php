<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lowongan extends Model
{
    protected $fillable = ['dudi_profile_id', 'judul', 'gambar', 'deskripsi', 'tanggal_mulai', 'tanggal_selesai', 'is_published'];

    protected function casts(): array
    {
        return [
            'tanggal_mulai' => 'date',
            'tanggal_selesai' => 'date',
            'is_published' => 'boolean',
        ];
    }

    public function dudiProfile()
    {
        return $this->belongsTo(DudiProfile::class);
    }
    public function posisis()
    {
        return $this->hasMany(Posisi::class);
    }
}