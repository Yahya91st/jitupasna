<?php

namespace Database\Seeders;

use App\Models\Bencana;
use Illuminate\Database\Seeder;
use database\factories\BencanaFactory;

class BencanaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 1; $i <= 10; $i++) {
            $randomDay = rand(1, 31);
            $tanggal = '2025-01-' . str_pad($randomDay, 2, '0', STR_PAD_LEFT);

            BencanaFactory::new()->create([
            'jenis_bencana' => Bencana::JENIS_BENCANA_OPTIONS[array_rand(Bencana::JENIS_BENCANA_OPTIONS)],  
            'tanggal' => $tanggal,
            'province_code' => 'P' . str_pad(rand(1, 34), 2, '0', STR_PAD_LEFT),
            'regency_code' => 'R' . str_pad(rand(1, 100), 3, '0', STR_PAD_LEFT),
            'district_code' => 'D' . str_pad(rand(1, 500), 3, '0', STR_PAD_LEFT),
            'village_code' => 'V' . str_pad(rand(1, 1000), 4, '0', STR_PAD_LEFT),
            'deskripsi' => 'Deskripsi bencana ' . $i,
            'gambar' => 'https://via.placeholder.com/150',
        ]);
        
        }
    }
}
