<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Form7 extends Model
{
    use HasFactory;

    protected $table = 'form7';

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

    protected $casts = [
        'tanggal' => 'date',
        'akses_hak' => 'string',
        'fungsi_pranata' => 'string',
        'resiko_kerentanan' => 'string',
    ];

    // Relasi ke Bencana
    public function bencana()
    {
        return $this->belongsTo(Bencana::class);
    }

}