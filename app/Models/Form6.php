<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Form6 extends Model
{
    use HasFactory;

    protected $table = 'form6';

    protected $fillable = [
        'bencana_id',
        
        // Pengumpulan data
        'enumerator',
        'tgl_wawancara',
        'paraf_enum',
        
        // Perekaman data
        'data_entry',
        'tgl_entry',
        'paraf_entry',
        
        // Informasi Umum Responden
        'responden_l',
        'responden_p',
        
        // Umur responden
        'umur_20',
        'umur_21_30',
        'umur_31_40',
        'umur_41_50',
        'umur_50plus',
        
        'nama',
        'desa',
        'kecamatan',
        'kabupaten',
        
        // Pendidikan terakhir
        'pend_sd',
        'pend_sltp',
        'pend_slta',
        'pend_pt',
        
        // Kepala rumah tangga perempuan
        'krt_perempuan_ya',
        'krt_perempuan_tidak',
        
        // Jumlah anggota keluarga berdasarkan umur
        'anggota_0_5',
        'anggota_6_17',
        'anggota_18_59',
        'anggota_60plus',
        
        // Status rumah
        'rumah_milik_sendiri',
        'rumah_sewa',
        'rumah_menumpang',
        
        // Kondisi rumah sebelum bencana
        'kondisi_baik',
        'kondisi_rusak_ringan',
        'kondisi_rusak_sedang',
        'kondisi_rusak_berat',
        
        // Kerusakan akibat bencana
        'kerusakan_tidak_ada',
        'kerusakan_ringan',
        'kerusakan_sedang',
        'kerusakan_berat',
        'kerusakan_hancur',
        
        // Status tempat tinggal saat ini
        'tinggal_rumah_sendiri',
        'tinggal_rumah_saudara',
        'tinggal_mengungsi',
        'tinggal_tenda',
        
        // Penghasilan per bulan sebelum bencana
        'penghasilan_suami',
        'bidang_suami',
        'penghasilan_istri',
        'bidang_istri',
        'penghasilan_lainnya',
        'bidang_lainnya',
    ];

    protected $casts = [
        'tgl_wawancara' => 'date',
        'tgl_entry' => 'date',
        'responden_l' => 'boolean',
        'responden_p' => 'boolean',
        'umur_20' => 'boolean',
        'umur_21_30' => 'boolean',
        'umur_31_40' => 'boolean',
        'umur_41_50' => 'boolean',
        'umur_50plus' => 'boolean',
        'pend_sd' => 'boolean',
        'pend_sltp' => 'boolean',
        'pend_slta' => 'boolean',
        'pend_pt' => 'boolean',
        'krt_perempuan_ya' => 'boolean',
        'krt_perempuan_tidak' => 'boolean',
        'rumah_milik_sendiri' => 'boolean',
        'rumah_sewa' => 'boolean',
        'rumah_menumpang' => 'boolean',
        'kondisi_baik' => 'boolean',
        'kondisi_rusak_ringan' => 'boolean',
        'kondisi_rusak_sedang' => 'boolean',
        'kondisi_rusak_berat' => 'boolean',
        'kerusakan_tidak_ada' => 'boolean',
        'kerusakan_ringan' => 'boolean',
        'kerusakan_sedang' => 'boolean',
        'kerusakan_berat' => 'boolean',
        'kerusakan_hancur' => 'boolean',
        'tinggal_rumah_sendiri' => 'boolean',
        'tinggal_rumah_saudara' => 'boolean',
        'tinggal_mengungsi' => 'boolean',
        'tinggal_tenda' => 'boolean',
    ];

    /**
     * Relationship with Bencana
     */
    public function bencana()
    {
        return $this->belongsTo(Bencana::class);
    }
}
