<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EnvironmentalLoss extends Model
{
    protected $fillable = [
        'bencana_id',
        'jenis_kerugian',
        'jenis',
        'dasar_perhitungan',
        'rb',
        'rs',
        'rr',
        'harga_rb',
        'harga_rs',
        'harga_rr',
    ];

    public function bencana()
    {
        return $this->belongsTo(Bencana::class);
    }
}