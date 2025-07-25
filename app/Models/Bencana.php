<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bencana extends Model
{
    use HasFactory;

    protected $table = 'bencana';

    protected $fillable = ['kategori_bencana_id', 'tanggal', 'kecamatan_id', 'latitude', 'longitude', 'Ref','deskripsi','gambar'];
    
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
    
    public function format1Form4()
    {
        return $this->hasMany(Format1Form4::class, 'bencana_id', 'id');
    }

    public function kecamatan()
    {
        return $this->belongsTo(Kecamatan::class, 'kecamatan_id');
    }
}
