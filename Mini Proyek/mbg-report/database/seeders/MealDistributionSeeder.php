<?php

namespace Database\Seeders;

use App\Models\MealDistribution;
use App\Models\School;
use App\Models\Sppg;
use Illuminate\Database\Seeder;

class MealDistributionSeeder extends Seeder
{
    public function run(): void
    {
        $sppg = Sppg::first();

        foreach (School::all() as $school) {
            MealDistribution::updateOrCreate(
                [
                    'school_id'          => $school->id,
                    'tanggal_distribusi' => now()->subDay()->toDateString(),
                ],
                [
                    'sppg_id'      => $sppg->id,
                    'menu'         => 'Nasi, ayam goreng, sayur, buah',
                    'jumlah_porsi' => 800,
                    'status'       => 'diterima',
                ]
            );
        }
    }
}