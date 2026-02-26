<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class Industry extends Model
{
    use HasUuids;

    protected $fillable = ['nama'];

    public function dudiProfiles()
    {
        return $this->hasMany(DudiProfile::class);
    }
}