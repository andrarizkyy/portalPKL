<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Industry extends Model
{
    protected $fillable = ['nama'];

    public function dudiProfiles()
    {
        return $this->hasMany(DudiProfile::class);
    }
}