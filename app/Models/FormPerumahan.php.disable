<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FormPerumahan extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'form_perumahan';

    protected $fillable = [
        'bencana_id',
        'nama_kampung',
        'nama_distrik',
        'rumah_hancur_total_permanen',
        'rumah_rusak_berat_permanen',
        'rumah_rusak_sedang_permanen',
        'rumah_rusak_ringan_permanen',
        'harga_satuan_permanen',
        'rumah_hancur_total_non_permanen',
        'rumah_rusak_berat_non_permanen',
        'rumah_rusak_sedang_non_permanen',
        'rumah_rusak_ringan_non_permanen',
        'harga_satuan_non_permanen',
        'jalan_rusak_berat',
        'jalan_rusak_sedang',
        'jalan_rusak_ringan',
        'harga_satuan_jalan',
        'saluran_rusak_berat',
        'saluran_rusak_sedang',
        'saluran_rusak_ringan',
        'harga_satuan_saluran',
        'balai_rusak_berat',
        'balai_rusak_sedang',
        'harga_satuan_balai',
        'tenaga_kerja_hok',
        'upah_harian',
        'alat_berat_hari',
        'biaya_per_hari',
        'harga_sewa_per_bulan',
        'jumlah_tenda',
        'harga_tenda',
        'jumlah_barak',
        'harga_barak',
        'jumlah_rumah_sementara',
        'harga_rumah_sementara',
    ];

    protected $casts = [
        'harga_satuan_permanen' => 'decimal:2',
        'harga_satuan_non_permanen' => 'decimal:2',
        'harga_satuan_jalan' => 'decimal:2',
        'harga_satuan_saluran' => 'decimal:2',
        'harga_satuan_balai' => 'decimal:2',
        'upah_harian' => 'decimal:2',
        'biaya_per_hari' => 'decimal:2',
        'harga_sewa_per_bulan' => 'decimal:2',
        'harga_tenda' => 'decimal:2',
        'harga_barak' => 'decimal:2',
        'harga_rumah_sementara' => 'decimal:2',
    ];

    public function bencana()
    {
        return $this->belongsTo(Bencana::class);
    }
}