<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Jurusan extends Model
{
    protected $table = 'jurusan';

    protected $fillable = ['sekolah_id', 'name', 'logo'];

    public function sekolah()
    {
        return $this->belongsTo(Sekolah::class);
    }
}