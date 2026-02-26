<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class Lowongan extends Model
{
    use HasUuids;

    protected $table = 'lowongans';

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
        return $this->belongsTo(DudiProfile::class , 'dudi_profile_id');
    }
    public function posisis()
    {
        return $this->hasMany(Posisi::class , 'lowongan_id');
    }
    public function jurusans()
    {
        return $this->belongsToMany(Jurusan::class , 'lowongan_jurusan');
    }
}