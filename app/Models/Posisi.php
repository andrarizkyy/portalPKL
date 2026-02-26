<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class Posisi extends Model
{
    use HasUuids;

    protected $table = 'posisis';

    protected $fillable = ['lowongan_id', 'nama', 'kuota'];

    public function lowongan()
    {
        return $this->belongsTo(Lowongan::class);
    }
    public function pendaftaranPkls()
    {
        return $this->hasMany(PendaftaranPkl::class , 'posisi_id');
    }

    public function sisaTempat(): int
    {
        return $this->kuota - $this->pendaftaranPkls()->where('status', 'approved')->count();
    }
}