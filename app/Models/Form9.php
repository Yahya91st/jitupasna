<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Form9 extends Model
{
    use HasFactory;
    
    protected $table = 'form9';
    
    protected $fillable = [
        'bencana_id',
        'pertanyaan_no',
        'jawaban_index',
        'kuesioner_1',
        'kuesioner_2',
        'kuesioner_3',
        'kuesioner_4',
        'kuesioner_5',
        'kuesioner_6',
        'jumlah',
        'persentase',
    ];
    
    // Cast array data properly for multi-select fields
    protected $casts = [
        'dukungan_pangan_air' => 'array',
        // Add other array fields here as needed
    ];
    
    public function bencana()
    {
        return $this->belongsTo(Bencana::class);
    }
}
