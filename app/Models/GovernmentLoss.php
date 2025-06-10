<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GovernmentLoss extends Model
{
    protected $fillable = [
        'bencana_id',
        'tenaga_kerja_hok',
        'upah_harian',
        'alat_berat_hari',
        'biaya_per_hari_alat_berat',
        'jumlah_unit',
        'biaya_sewa_per_unit',
        'jumlah_arsip',
        'harga_satuan',
        'dasar_perhitungan',
    ];

    public function bencana()
    {
        return $this->belongsTo(Bencana::class);
    }
}
