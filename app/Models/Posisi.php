<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Posisi extends Model
{
    protected $fillable = ['lowongan_id', 'nama', 'kuota'];

    public function lowongan()
    {
        return $this->belongsTo(Lowongan::class);
    }
    public function pendaftaranPkls()
    {
        return $this->hasMany(PendaftaranPkl::class);
    }

    public function sisaTempat(): int
    {
        return $this->kuota - $this->pendaftaranPkls()->where('status', 'approved')->count();
    }
}