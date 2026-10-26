<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'nama_lengkap' => 'Rina Siti Marfuah',
            'email' => 'RinaSM@gmail.com',
            'username' => 'rinasm',
            'password' => 'cantik123',
            'role' => 'pelapor',
            'no_hp' => '081234567890',
        ]);
    }
}