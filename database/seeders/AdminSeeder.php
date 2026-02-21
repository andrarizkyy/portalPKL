<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
        ['email' => 'admin@portal.com'],
        [
            'name' => 'Administrator',
            'password' => Hash::make('password'),
            'role' => 'admin',
            'google_id' => null,
            'is_profile_completed' => true,
        ]
        );
    }
}