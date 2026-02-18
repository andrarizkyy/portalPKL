<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DudiProfile extends Model
{
    protected $fillable = ['user_id', 'industry_id', 'nama_perusahaan', 'website', 'telepon', 'alamat', 'status'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function industry()
    {
        return $this->belongsTo(Industry::class);
    }
    public function lowongans()
    {
        return $this->hasMany(Lowongan::class);
    }
}