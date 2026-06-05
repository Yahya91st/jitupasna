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
        'village_code',
        'deskripsi',
        'gambar'
    ];

    protected $casts = [
        'tanggal' => 'date',
        'verifikasi' => 'boolean',
    ];

    public static function jenisBencanaOptions(): array
    {
        return self::JENIS_BENCANA_OPTIONS;
    }

    public function laporanBencanas()
    {
        return $this->hasMany(LaporanBencana::class, 'bencana_id');
    }
}
