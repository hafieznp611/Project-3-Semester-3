<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'id_user'      => 'USR001',
            'nama_lengkap' => 'Hafiez Novrizal Putra',
            'email'        => 'hafieznp611@gmail.com',
            'username'     => 'hafiez',
            'password'     => 'ganteng123',
            'no_hp'        => '082118981640',
            'alamat'       => 'Permata Cimahi 2 Blok N 15',
        ]);

        User::create([
            'id_user'      => 'USR002',
            'nama_lengkap' => 'Akun Kedua Hafiez',
            'email'        => 'hafiez2@gmail.com.com',
            'username'     => 'Hafiez2',
            'password'     => 'ganteng456',
            'no_hp'        => '082118981640',
            'alamat'       => 'Permata Cimahi 2 Blok N 15',
        ]);
    }
}