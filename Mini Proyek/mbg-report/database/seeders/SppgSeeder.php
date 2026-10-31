<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Sppg;    

class SppgSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Sppg::create([
            'nama' => 'SPPG Bandung Gegerkalong',
            'penanggung_jawab' => 'Ahmad Yani',
            'kontak_penanggung_jawab' => '082198761234',
        ]);
    }
}
