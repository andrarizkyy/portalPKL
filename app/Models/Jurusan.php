<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Jurusan extends Model
{
    protected $fillable = ['sekolah_id', 'nama'];

    public function sekolah()
    {
        return $this->belongsTo(Sekolah::class);
    }
}