<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bencana extends Model
{
    use HasFactory;

    protected $table = 'bencana';

    protected $fillable = [
        'ref',
        'kategori_bencana_id',
        'tanggal', 
        'province_code', 
        'regency_code', 
        'district_code',
        'village_code',
        'deskripsi',
        'gambar'
    ];
    
    protected $appends = ['nama_bencana'];
    
    public function getNamaBencanaAttribute()
    {
        return $this->Ref;
    }

    public function kategori_bencana()
    {
        return $this->belongsTo(KategoriBencana::class, 'kategori_bencana_id', 'id');
    }

    public function kerusakan()
    {
        return $this->hasMany(Kerusakan::class, 'bencana_id', 'id');
    }

    public function kerugian()
    {
        return $this->hasMany(Kerugian::class, 'bencana_id', 'id');
    }

    public function rumahtangga()
    {
        return $this->hasMany(Rumahtangga::class, 'bencana_id', 'id');
    }

    public function desa()
    {
        return $this->belongsToMany(Desa::class, 'wilayah_bencana', 'bencana_id', 'desa_id');
    }
    
    public function rekap()
    {
        return $this->hasOne(Rekap::class, 'bencana_id', 'id');
    }

    public function kecamatan()
    {
        return $this->belongsTo(Kecamatan::class, 'kecamatan_id');
    }

    public function pendataan()
    {
        return $this->hasOne(Pendataan::class, 'bencana_id', 'id');
    }
}
