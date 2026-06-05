<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FormulirItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'format_id',
        'kriteria_id',
        'kategori',
        'sub_kategori',
        'dimensi_1',
        'dimensi_2',
        'tingkat_kerusakan',
        'jumlah',
        'harga_satuan',
        'satuan',
    ];

    public function formatFormulir()
    {
        return $this->belongsTo(FormatFormulir::class, 'format_id');
    }

    public function kriteriaKerusakan()
    {
        return $this->belongsTo(KriteriaKerusakan::class, 'kriteria_id');
    }
}
