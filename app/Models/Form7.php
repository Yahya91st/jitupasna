<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Form7 extends Model
{
    use HasFactory;

    protected $table = 'form7';

    protected $fillable = [
        'bencana_id',
        'desa_kelurahan',
        'kecamatan',
        'kabupaten',
        'tanggal',
        'jarak_bencana',
        'tempat_sesi',
        'jumlah_peserta',
        'jumlah_perempuan',
        'jumlah_laki_laki',
        'komposisi_peserta',
        'fasilitator',
        'pencatat',

        // Checklist Persiapan
        'persiapan_pra_fgd'  ,
        'pembagian_tugas_pelaksana'  ,
        'perkenalan_pengantar'  ,
        'pembahasan'  ,
        'pendalaman_tanya_jawab'  ,
        'penyimpulan_penutupan'  ,

        // A. Akses Hak
        'akses_hak_bekerja'  ,
        'akses_hak_jamsos'  ,
        'akses_hak_perlindungan' ,  
        'akses_hak_kesehatan'  ,
        'akses_hak_pendidikan'  ,

        // B. Fungsi Pranata
        'fungsi_pranata_sosial'  ,
        'fungsi_pranata_ekonomi'  ,
        'fungsi_pranata_agama'  ,
        'fungsi_pranata_pemerintahan' , 

        // C. Resiko Kerentanan
        'resiko_kerentanan_sosial'  ,
        'resiko_kerentanan_ekonomi'  ,
        'resiko_kerentanan_geografis' , 

    ];

    protected $casts = [
        'tanggal' => 'date',
        'akses_hak' => 'string',
        'fungsi_pranata' => 'string',
        'resiko_kerentanan' => 'string',
    ];

    // Relasi ke Bencana
    public function bencana()
    {
        return $this->belongsTo(Bencana::class);
    }

}