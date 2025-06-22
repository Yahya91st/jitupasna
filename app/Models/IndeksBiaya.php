<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class IndeksBiaya extends Model
{
    protected $table = 'indeks_biaya';
    
    protected $fillable = [
        'provinsi',
        'kota',
        'indeks_umum',
        'indeks_perumahan',
        'indeks_kesehatan',
        'indeks_pendidikan',
        'indeks_sosial',
        'indeks_ekonomi',
        'indeks_infrastruktur',
        'indeks_pemerintahan',
        'created_by',
        'updated_by',
    ];
}
