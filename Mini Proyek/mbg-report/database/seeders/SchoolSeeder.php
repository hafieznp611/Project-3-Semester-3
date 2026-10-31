<?php

namespace Database\Seeders;

use App\Models\School;
use App\Models\Sppg;
use Illuminate\Database\Seeder;

class SchoolSeeder extends Seeder
{
    public function run(): void
    {
        $sppg = Sppg::first();   // SPPG Bandung Gegerkalong

        $schools = [
            ['nama' => 'SDN 1 Gegerkalong', 'kecamatan' => 'Sukasari'],
            ['nama' => 'SDN 2 Gegerkalong', 'kecamatan' => 'Sukasari'],
            ['nama' => 'SDN 1 Sarijadi',    'kecamatan' => 'Sukasari'],
            ['nama' => 'SDN 2 Sarijadi',    'kecamatan' => 'Sukasari'],
        ];

        foreach ($schools as $school) {
            School::updateOrCreate(
                ['nama' => $school['nama']],                 
                $school + ['sppg_id' => $sppg->id]        
            );
        }
    }
}