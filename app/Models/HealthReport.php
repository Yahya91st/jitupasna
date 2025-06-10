<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HealthReport extends Model
{
    protected $fillable = [
        'bencana_id',
        'jenis_fasilitas',
        'nama_fasilitas',
        'rusak_berat',
        'rusak_sedang', 
        'rusak_ringan',
        'biaya_rb',
        'biaya_rs',
        'biaya_rr',
        'total_biaya',
        'keterangan'
    ];

    protected $casts = [
        'biaya_rb' => 'decimal:2',
        'biaya_rs' => 'decimal:2', 
        'biaya_rr' => 'decimal:2',
        'total_biaya' => 'decimal:2',
    ];

    public function bencana()
    {
        return $this->belongsTo(Bencana::class);
    }
}
