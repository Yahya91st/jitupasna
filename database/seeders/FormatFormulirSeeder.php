<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\FormatFormulir;

class FormatFormulirSeeder extends Seeder
{
    public function run(): void
    {
        $formats = [
            'Perumahan',
            'Pendidikan',
            'Kesehatan',
            'Perlindungan Sosial',
            'Keagamaan',
            'Air Minum',
            'Transportasi',
            'Listrik',
            'Telekomunikasi',
            'Pertanian',
            'Peternakan',
            'Perikanan',
            'Industri UMKM',
            'Perdagangan',
            'Pariwisata',
            'Pemerintahan',
            'Lingkungan Hidup',
        ];

        foreach ($formats as $index => $nama) {
            FormatFormulir::create([
                'kode_format' => 'F' . ($index + 1),
                'nama_sektor' => $nama,
            ]);
        }
    }
}