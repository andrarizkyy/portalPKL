<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class Jurusan extends Model
{
    use HasUuids;

    protected $table = 'jurusans';

    protected $fillable = ['sekolah_id', 'nama'];

    public function sekolah()
    {
        return $this->belongsTo(Sekolah::class);
    }

    public function lowongans()
    {
        return $this->belongsToMany(Lowongan::class , 'lowongan_jurusan');
    }
}