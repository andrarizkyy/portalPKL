<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lowongan extends Model
{
    protected $table = 'lowongan_pkl';

    protected $fillable = ['dudi_id', 'title', 'image', 'description', 'start_date', 'end_date', 'is_active', 'is_published'];

    protected function casts(): array
    {
        return [
            'start_date' => 'date',
            'end_date' => 'date',
            'is_published' => 'boolean',
            'is_active' => 'boolean',
        ];
    }

    public function dudiProfile()
    {
        return $this->belongsTo(DudiProfile::class , 'dudi_id');
    }
    public function posisis()
    {
        return $this->hasMany(Posisi::class , 'lowongan_id');
    }
}