<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Form9Row extends Model
{
    use HasFactory;

    protected $table = 'form9_rows';

    protected $fillable = [
        'form9_id',
        'pertanyaan_no',
        'jawaban_index',
        'kuesioner_1','kuesioner_2','kuesioner_3',
        'kuesioner_4','kuesioner_5','kuesioner_6',
        'jumlah','persentase',
    ];

    public function form9()
    {
        return $this->belongsTo(Form9::class, 'form9_id');
    }
}