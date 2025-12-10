<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Form8 extends Model
{
    use HasFactory;

    protected $table = 'form8';

    protected $fillable = [
        'bencana_id',
        'tanggal',
        'keterangan',
        'nomor_dokumen',
        'tim_penilai',
        'metodologi',
        'sektor_terkena_dampak',
        'dampak_ekonomi',
        'dampak_sosial',
        'kebutuhan_pemulihan',
        'kesimpulan',
        'rekomendasi',
        'nama_penandatangan',
        'jabatan_penandatangan',
    ];

    /**
     * Relationship with Bencana
     */
    public function bencana()
    {
        return $this->belongsTo(Bencana::class);
    }

    public function rows()
    {
        return $this->hasMany(Form8Row::class, 'form8_id');
    }
}
