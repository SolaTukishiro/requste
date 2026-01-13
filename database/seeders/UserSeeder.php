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
        $clients = [
            [
                'name' => 'Client1 User',
                'email' => 'client1@test.com',
                'password' => Hash::make('password'),
                'role' => UserRole::CLIENT,
            ],
            [
                'name' => 'Client2 User',
                'email' => 'client2@test.com',
                'password' => Hash::make('password'),
                'role' => UserRole::CLIENT,
            ]
        ];

        $creators = [
            [
                'name' => 'Creator1 User',
                'email' => 'creator1@test.com',
                'password' => Hash::make('password'),
                'role' => UserRole::CREATOR,
            ],
            [
                'name' => 'Creator2 User',
                'email' => 'creator2@test.com',
                'password' => Hash::make('password'),
                'role' => UserRole::CREATOR,
            ]
        ];

        foreach($clients as $client){
            User::create($client);
        }


        foreach($creators as $creator){
            User::create($creator);
        }
    }
}
