<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kajian extends Model
{
    use HasFactory;

    protected $fillable = [
        'laporan_id',
        'peningkatan_resiko',
        'gangguan_fungsi',
        'kehilangan_akses',
        'status_kajian',
        'catatan_revisi',
    ];

    public function laporanBencana()
    {
        return $this->belongsTo(LaporanBencana::class, 'laporan_id');
    }

}
