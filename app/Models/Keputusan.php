<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Keputusan extends Model
{
    use HasFactory;

    protected $fillable = [
        'laporan_id',
        'prioritas',
        'keputusan',
    ];

    public function laporan()
    {
        return $this->belongsTo(LaporanBencana::class, 'laporan_id');
    }
}
