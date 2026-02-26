<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
        ['email' => 'admin@portal.com'],
        [
            'name' => 'Admin Portal',
            'password' => Hash::make('password'),
            'role' => 'admin',
            'is_profile_completed' => true,
        ]
        );
    }
}