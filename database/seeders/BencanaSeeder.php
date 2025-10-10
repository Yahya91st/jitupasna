<?php

namespace Database\Seeders;

use App\Models\Bencana;
use Illuminate\Database\Seeder;

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

            Bencana::firstOrCreate([
                'ref' => 'Bencana-' . $i,
                'tanggal' => $tanggal,
                'kategori_bencana_id' => $i,
                'kecamatan_id' => $i,
                'deskripsi' => 'Deskripsi bencana ke-' . $i,
                'gambar' => 'gambar' . $i . '.jpg'
            ]);
        }
    }
}
