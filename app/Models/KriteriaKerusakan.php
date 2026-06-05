<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KriteriaKerusakan extends Model
{
    use HasFactory;

    protected $fillable = [
        'format_id',
        'tingkat',
        'deskripsi',
    ];

    public function formatFormulir()
    {
        return $this->belongsTo(FormatFormulir::class, 'format_id');
    }

    public function formulirItems()
    {
        return $this->hasMany(FormulirItem::class, 'kriteria_id');
    }
}
