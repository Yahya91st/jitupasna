<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GovernmentDamage extends Model
{
    protected $fillable = [
        'bencana_id',
        'jenis_fasilitas',
        'jumlah_rb',
        'jumlah_rs',
        'jumlah_rr',
        'harga_rb',
        'harga_rs',
        'harga_rr',
    ];

    public function bencana()
    {
        return $this->belongsTo(Bencana::class);
    }
}
