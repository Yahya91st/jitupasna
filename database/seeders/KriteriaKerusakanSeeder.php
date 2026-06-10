<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\FormatFormulir;
use App\Models\KriteriaKerusakan;

class KriteriaKerusakanSeeder extends Seeder
{
    public function run(): void
    {
        $formats = FormatFormulir::all();

        foreach ($formats as $format) {

            KriteriaKerusakan::create([
                'format_id' => $format->id,
                'tingkat' => 'RR',
                'persentase_min' => 0,
                'persentase_max' => 29.99,
                'deskripsi' => 'Rusak Ringan (<30%)'
            ]);

            KriteriaKerusakan::create([
                'format_id' => $format->id,
                'tingkat' => 'RS',
                'persentase_min' => 30,
                'persentase_max' => 70,
                'deskripsi' => 'Rusak Sedang (30%-70%)'
            ]);

            KriteriaKerusakan::create([
                'format_id' => $format->id,
                'tingkat' => 'RB',
                'persentase_min' => 70.01,
                'persentase_max' => 100,
                'deskripsi' => 'Rusak Berat (>70%)'
            ]);
        }
    }
}