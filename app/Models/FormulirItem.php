<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FormulirItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'formulir_id',
        'kriteria_id',

        'kategori',
        'sub_kategori',

        'nama',
        'jenis',
        'tipe',

        'dimensi',

        'tingkat_kerusakan',

        'jumlah',
        'jumlah2',

        'harga_satuan',

        'satuan',

        'durasi',
        'durasi_satuan',
    ];
    public function formulir()
    {
        return $this->belongsTo(Formulir::class);
    }

    public function kriteriaKerusakan()
    {
        return $this->belongsTo(KriteriaKerusakan::class, 'kriteria_id');
    }
}
