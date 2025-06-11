<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rumahtangga extends Model
{
    use HasFactory;

    protected $table = 'rumahtangga';
    
    protected $fillable = [
        'bencana_id',
        'provinsi',
        'kabupaten',
        'kecamatan',
        'desa',
        'dusun',
        'rt',
        'rw',
        'nama_kk',
        'nik_kk',
        'jumlah_anggota',
        'status_rumah',
        'kebutuhan_material',
        'kebutuhan_sdm',
        'kebutuhan_dana',
        'kategori_kerusakan',
        'keterangan_tambahan',
        'foto_rumah',
        'foto_ktp',
        'foto_kk',
        'nomor_hp',
        'status_hunian',
        'status_bantuan',
        'jenis_bantuan',
        'nominal_bantuan',
        'pemberi_bantuan',
        'created_by',
        'updated_by'
    ];

    public function bencana()
    {
        return $this->belongsTo(Bencana::class, 'bencana_id');
    }

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function updatedBy()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }
}
