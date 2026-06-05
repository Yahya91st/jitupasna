<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Bencana>
 */
class BencanaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'id' => $this->faker->unique()->randomNumber(),
            'jenis_bencana' => $this->faker->randomElement([
                'banjir',
                'kebakaran',
                'gempa_bumi',
                'tanah_longsor',
                'angin_puting_beliung',
                'tsunami',
                'letusan_gunung_berapi',
                'kekeringan',
                'abrasi',
                'gelombang_pasang',
                'kebakaran_hutan_lahan',
                'wabah_penyakit',
                'lainnya',
            ]),
            'tanggal' => $this->faker->date(),
            'province_code' => $this->faker->stateAbbr(),
            'regency_code' => $this->faker->citySuffix(),
            'district_code' => $this->faker->streetSuffix(),
            'village_code' => $this->faker->streetName(),
            'gambar' => $this->faker->imageUrl(),
            'deskripsi' => $this->faker->paragraph(),
            'verifikasi' => $this->faker->boolean(),
        ];    
    }
}
