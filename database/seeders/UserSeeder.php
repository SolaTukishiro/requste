<?php

namespace Database\Seeders;

use App\Enums\UserRole;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Client User',
            'email' => 'client@test.com',
            'password' => Hash::make('password'),
            'role' => UserRole::CLIENT,
        ]);

        User::create([
            'name' => 'Creator User',
            'email' => 'creator@test.com',
            'password' => Hash::make('password'),
            'role' => UserRole::CREATOR,
        ]);
    }
}
