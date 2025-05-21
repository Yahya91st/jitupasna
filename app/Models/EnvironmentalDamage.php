<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EnvironmentalDamage extends Model
{
    protected $fillable = [
        'bencana_id',
        'ekosistem',
        'jenis_kerusakan',
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