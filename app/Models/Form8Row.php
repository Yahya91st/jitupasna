<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Form8Row extends Model
{
    protected $table = 'form8_rows';

    protected $fillable = [
        'form8_id',
        'sektor_sub_sektor',
        'komponen_kerusakan',
        'lokasi',
        'data_kerusakan_rb',
        'data_kerusakan_rs',
        'data_kerusakan_rr',
        'harga_satuan_rb',
        'harga_satuan_rs',
        'harga_satuan_rr',
        'nilai_kerusakan_rb',
        'nilai_kerusakan_rs',
        'nilai_kerusakan_rr',
        'perkiraan_kerugian',
        'jumlah_kerusakan_kerugian',
        'kebutuhan',
    ];

    public function form8()
    {
        return $this->belongsTo(Form8::class, 'form8_id');
    }
}