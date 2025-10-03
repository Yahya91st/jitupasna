<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Form3 extends Model
{
    use HasFactory;

    protected $table = 'form3';

    protected $fillable = [
        'bencana_id',
        'wilayah_bencana',
        'tim_fgd',
        'fasilitator',
        'notulis',
        'tanggal_fgd',
        'waktu_mulai',
        'waktu_selesai',
        'lokasi_fgd',
        
        // Data Dasar Sebelum Bencana - Penduduk
        'penduduk_laki_laki',
        'penduduk_perempuan',
        'penduduk_rumah_tangga',
        
        // Data Dasar Sebelum Bencana - Sarana Kesehatan
        'rumah_sakit',
        'puskesmas',
        'puskesmas_pembantu',
        'polindes',
        'posyandu',
        
        // Data Dasar Sebelum Bencana - Tenaga Kesehatan
        'dokter',
        'paramedis',
        'bidan',
        'kader_kesehatan',
        
        // Data Dasar Sebelum Bencana - Balita
        'balita',
        'balita_gizi_buruk',
        'balita_gizi_kurang',
        'ditimbang_posyandu',
        
        // FGD Questions
        'program_kesehatan_masal',
        'permasalahan_kesehatan',
        'kegiatan_permasalahan_kesehatan',
        'program_makanan_tambahan',
        'jumlah_balita_terdampak',
        'dampak_balita',
        'kegiatan_balita',
        'jumlah_ibu_hamil_terdampak',
        'dampak_ibu_hamil',
        'kegiatan_ibu_hamil',
        'jumlah_lansia_terdampak',
        'dampak_lansia',
        'kegiatan_lansia',
        'dampak_kesehatan_menengah',
        'kegiatan_dampak_kesehatan',
        'rencana_kontingensi_kesehatan',
    ];

    protected $casts = [
        'tanggal_fgd' => 'date',
        'waktu_mulai' => 'datetime',
        'waktu_selesai' => 'datetime',
    ];

    /**
     * Relationship with Bencana
     */
    public function bencana()
    {
        return $this->belongsTo(Bencana::class);
    }
}
