<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FormatFormulir extends Model
{
    use HasFactory;

    protected $fillable = [
        'kode_format',
        'nama_sektor',
    ];

    public function kriteriaKerusakans()
    {
        return $this->hasMany(KriteriaKerusakan::class, 'format_id');
    }

    public function formulirItems()
    {
        return $this->hasMany(FormulirItem::class, 'format_id');
    }
}
