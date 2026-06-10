<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Bencana;
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
    protected $model = Bencana::class;

    public function definition(): array
    {
        $villages = [
            '33.72.04.1001' => 'Kepatihan Kulon',
            '33.72.04.1002' => 'Kepatihan Wetan',
            '33.72.04.1003' => 'Sudiroprajan',
            '33.72.04.1004' => 'Gandekan',
            '33.72.04.1005' => 'Sewu',
            '33.72.04.1006' => 'Pucangsawit',
            '33.72.04.1007' => 'Jagalan',
            '33.72.04.1008' => 'Purwodiningratan',
            '33.72.04.1009' => 'Tegalharjo',
            '33.72.04.1010' => 'Jebres',
            '33.72.04.1011' => 'Mojosongo',
        ];
        return [
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
            'province_code' => '33',
            'regency_code' => '33.72',
            'district_code' => '33.72.04',
            'village_codes' => collect($villages)
                ->shuffle()
                ->take(rand(1, 5))
                ->toArray(),
            'gambar' => $this->faker->imageUrl(),
            'deskripsi' => $this->faker->paragraph(),
            'verifikasi' => $this->faker->boolean(),
        ];
    }
}
