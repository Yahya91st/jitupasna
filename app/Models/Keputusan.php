<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Keputusan extends Model
{
    use HasFactory;

    protected $fillable = [
        'laporan_id',
        'hasil_keputusan',
        'tindak_lanjut',
        'status_keputusan',
        'catatan_pimpinan',
    ];

    public function laporanBencana()
    {
        return $this->belongsTo(LaporanBencana::class, 'laporan_id');
    }
}
