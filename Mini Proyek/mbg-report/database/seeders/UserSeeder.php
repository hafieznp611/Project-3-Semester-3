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
                'nama_lengkap' => 'Admin',
                'email'        => 'admin@gmail.com',
                'username'     => 'admin',
                'password'     => 'admin123',
                'no_hp'        => '081200000001',
                'role'         => 'admin',
            ],
            [
                'nama_lengkap' => 'Rina Siti Marfuah',
                'email'        => 'RinaSM@gmail.com',
                'username'     => 'rinasm',
                'password'     => 'cantik123',
                'no_hp'        => '081234567890',
                'role'         => 'complainant',
            ],
            [
                'nama_lengkap' => 'Hafiez Novrizal Putra',
                'email'        => 'hafieznp611@gmail.com',
                'username'     => 'hafiez',
                'password'     => 'ganteng123',
                'no_hp'        => '081200000003',
                'role'         => 'reviewer',
            ],
        ];

        foreach ($users as $user) {
            $user['password'] = Hash::make($user['password']);
            User::create($user);
        }
    }
}