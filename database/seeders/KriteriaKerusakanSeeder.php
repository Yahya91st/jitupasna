<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\KriteriaKerusakan;

class KriteriaKerusakanSeeder extends Seeder
{
    public function run(): void
    {
            $data = [];

            $data = [
        [
            'tingkat' => 'hancur_total',
            'persentase' => 100,
            'deskripsi' => 'Bangunan hancur total',
        ],
        [
            'tingkat' => 'berat',
            'persentase' => 70,
            'deskripsi' => 'Kerusakan berat (>70%)',
        ],
        [
            'tingkat' => 'sedang',
            'persentase' => 50,
            'deskripsi' => 'Kerusakan sedang (30%-70%)',
        ],
        [
            'tingkat' => 'ringan',
            'persentase' => 30,
            'deskripsi' => 'Kerusakan ringan (<30%)',
        ],
    ];

    KriteriaKerusakan::insert($data);
    }
}