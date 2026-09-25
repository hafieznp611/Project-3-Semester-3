<?php

namespace Database\Seeders;

use App\Models\Activity;
use Illuminate\Database\Seeder;

class ActivitySeeder extends Seeder
{
    public function run(): void
    {
        Activity::query()->insert([
            [
                'title' => 'Workshop Git Dasar',
                'description' => 'Latihan kolaborasi repository.',
                'activity_date' => '2026-10-05',
                'category' => 'Workshop',
                'status' => 'Planned',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Seminar Web Quality',
                'description' => 'Pengenalan maintainability dan testing.',
                'activity_date' => '2026-10-12',
                'category' => 'Seminar',
                'status' => 'Planned',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Pengembangan Perangkat Lunak Berbasis Web',
                'description' => 'Belajar merancang web dari 0.',
                'activity_date' => '2026-10-20',
                'category' => 'Workshop',
                'status' => 'Planned',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Rapat Koordinasi Tim',
                'description' => 'Membahas progres proyek berjalan.',
                'activity_date' => '2026-09-20',
                'category' => 'Rapat',
                'status' => 'Ongoing',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Pelatihan Laravel Dasar',
                'description' => 'Sudah selesai dilaksanakan minggu lalu.',
                'activity_date' => '2026-09-10',
                'category' => 'Workshop',
                'status' => 'Done',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
