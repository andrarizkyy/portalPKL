<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name', 'email', 'password', 'role', 'google_id', 'profile_photo', 'is_profile_completed',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'is_profile_completed' => 'boolean',
        ];
    }

    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }
    public function isSiswa(): bool
    {
        return $this->role === 'siswa';
    }
    public function isDudi(): bool
    {
        return $this->role === 'dudi';
    }

    public function siswaProfile()
    {
        return $this->hasOne(SiswaProfile::class);
    }
    public function dudiProfile()
    {
        return $this->hasOne(DudiProfile::class);
    }
}