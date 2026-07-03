<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Formulir extends Model
{
    use HasFactory;

    protected $fillable = [
        'laporan_id',
        'format_id',
        'nama_kampung',
        'nama_distrik',
        'status',
        'verified_by',
        'verified_at',
        'catatan_revisi',
    ];

    public function verifier()
    {
        return $this->belongsTo(User::class, 'verified_by');
    }

    public function laporan()
    {
        return $this->belongsTo(LaporanBencana::class);
    }

    public function items()
    {
        return $this->hasMany(FormulirItem::class);
    }

    public function format()
    {
        return $this->belongsTo(FormatFormulir::class, 'format_id');
    }
}
