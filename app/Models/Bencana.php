<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bencana extends Model
{
    use HasFactory;

    public const JENIS_BENCANA_OPTIONS = [
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
    ];

    protected $table = 'bencanas';

    protected $fillable = [
        'jenis_bencana',
        'tanggal', 
        'province_code', 
        'regency_code', 
        'district_code',
        'village_codes',
        'deskripsi',
        'gambar'
    ];

    protected $casts = [
        'tanggal' => 'date',
        'verifikasi' => 'boolean',
        'village_codes' => 'array',

    ];

    public static function jenisBencanaOptions(): array
    {
        return self::JENIS_BENCANA_OPTIONS;
    }

    public function laporanBencanas()
    {
        return $this->hasMany(LaporanBencana::class, 'bencana_id');
    }

    protected function villageNames(): Attribute
    {
        return Attribute::make(
            get: function () {
                $codes = $this->village_codes; // sudah array karena cast

                return collect($codes)->map(function ($code) {
                    return Cache::remember("village:{$code}", now()->addDay(), function () use ($code) {
                        $response = Http::get("https://your-api.com/villages/{$code}");
                        return [
                            'code' => $code,
                            'name' => $response->ok() ? $response->json('name') : null,
                        ];
                    });
                })->toArray();
            }
        );
    }

}
