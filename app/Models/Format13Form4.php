<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Format13Form4 extends Model
{
    protected $table = 'format13_form4s';
    protected $fillable = [
        'bencana_id',
        'nama_kampung',
        'nama_distrik',
        'item_rusak_1', 'jumlah_rusak_1', 'harga_satuan_1',
        'item_rusak_2', 'jumlah_rusak_2', 'harga_satuan_2',
        'item_rusak_3', 'jumlah_rusak_3', 'harga_satuan_3',
        'item_rusak_4', 'jumlah_rusak_4', 'harga_satuan_4',
        'item_rusak_5', 'jumlah_rusak_5', 'harga_satuan_5',
        'total_biaya', 'keterangan',
    ];
    protected $casts = [
        'jumlah_rusak_1' => 'integer',
        'jumlah_rusak_2' => 'integer',
        'jumlah_rusak_3' => 'integer',
        'jumlah_rusak_4' => 'integer',
        'jumlah_rusak_5' => 'integer',
        'harga_satuan_1' => 'decimal:2',
        'harga_satuan_2' => 'decimal:2',
        'harga_satuan_3' => 'decimal:2',
        'harga_satuan_4' => 'decimal:2',
        'harga_satuan_5' => 'decimal:2',
        'total_biaya' => 'decimal:2',
    ];
}
