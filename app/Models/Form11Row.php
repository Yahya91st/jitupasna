<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Form11Row extends Model
{
    use HasFactory;

    protected $table = 'form11_rows';

    protected $fillable = [
        'form11_id',
        'sector_slug',
        'component_key',
        'row_index',
        'kegiatan',
        'lokasi',
        'volume',
        'harga',
        'jumlah',
        'keterangan',
        'main_lokasi',
        'jenis_kebutuhan',
        'rincian_kebutuhan',
        'jumlah_unit',
        'satuan',
        'harga_satuan',
        'total_kebutuhan',
        'prioritas',
        'durasi_penyelesaian',
        'penanggung_jawab',
    ];

    protected $casts = [
        'form11table_id' => 'integer',
        'row_index' => 'integer',
        'volume' => 'decimal:2',
        'harga' => 'decimal:2',
        'jumlah' => 'decimal:2',
        'jumlah_unit' => 'decimal:2',
        'harga_satuan' => 'decimal:2',
        'total_kebutuhan' => 'decimal:2',
    ];

    public function form11()
    {
        return $this->belongsTo(Form11::class, 'form11_id');
    }
}
