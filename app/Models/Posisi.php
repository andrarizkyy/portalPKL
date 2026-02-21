<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Posisi extends Model
{
    protected $table = 'lowongan_positions';

    protected $fillable = ['lowongan_id', 'position_name', 'kuota'];

    public function lowongan()
    {
        return $this->belongsTo(Lowongan::class);
    }
    public function pendaftaranPkls()
    {
        return $this->hasMany(PendaftaranPkl::class , 'position_id');
    }

    public function sisaTempat(): int
    {
        return $this->kuota - $this->pendaftaranPkls()->where('status', 'approved')->count();
    }
}