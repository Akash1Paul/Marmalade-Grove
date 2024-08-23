<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $userArr = [
            'user1' => [
                'name' => 'Admin',
                'email' => 'admin@gmail.com',
                'password' => Hash::make('12345678'),
                'roles' => 1
            ],

            'user2' => [
                'name' => 'Picker',
                'email' => 'picker@gmail.com',
                'password' => Hash::make('12345678'),
                'roles' => 2
            ],

            'user3' => [
                'name' => 'Packer',
                'email' => 'packer@gmail.com',
                'password' => Hash::make('12345678'),
                'roles' => 3
            ],

            'user4' => [
                'name' => 'Manager',
                'email' => 'manager@gmail.com',
                'password' => Hash::make('12345678'),
                'roles' => 4
            ],

        ];

        foreach ($userArr as $user) {
            User::create(
                [
                    'fname' => $user['fname'],
                    'email' => $user['email'],
                    'password' => $user['password'],
                    'roles' => $user['roles']
                ]
            );
        }
    }
}
