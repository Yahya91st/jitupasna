<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fgd extends Model
{
    use HasFactory;
    
    protected $table = 'fgd';
    
    protected $fillable = [
        'bencana_id',
        'desa_kelurahan',
        'kecamatan',
        'kabupaten',
        'tanggal',
        'jarak_bencana',
        'tempat_sesi',
        'jumlah_peserta',
        'jumlah_perempuan',
        'jumlah_laki_laki',
        'komposisi_peserta',
        'fasilitator',
        'pencatat',
        'akses_hak',
        'fungsi_pranata',
        'resiko_kerentanan',
        'created_by',
        'updated_by',
    ];
    
    public function bencana()
    {
        return $this->belongsTo(Bencana::class);
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
