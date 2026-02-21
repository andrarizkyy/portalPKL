<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DudiProfile extends Model
{
    protected $table = 'dudi';

    protected $fillable = ['user_id', 'industry_id', 'company_name', 'logo', 'website', 'phone', 'address', 'description', 'is_verified'];

    protected function casts(): array
    {
        return [
            'is_verified' => 'boolean',
        ];
    }

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
        return $this->hasMany(Lowongan::class , 'dudi_id');
    }
}