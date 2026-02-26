<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class DudiProfile extends Model
{
    use HasUuids;

    protected $table = 'dudi_profiles';

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
        return $this->hasMany(Lowongan::class , 'dudi_profile_id');
    }
}