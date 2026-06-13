<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $users = [
            [
                'username' => 'admin_cihuy',
                'email' => 'admin@mail.com',
                'password' => Hash::make('123'),
                'role' => 'admin',
            ],
            [
                'username' => 'wowo',
                'email' => 'wowo@mail.com',
                'password' => Hash::make('123'),
                'role' => 'pelanggan',
            ],
        ];

        foreach ($users as $user) {
            User::create($user);
        }
    }
}
