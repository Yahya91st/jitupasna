<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Form10Row extends Model
{
    use HasFactory;

    protected $table = 'Form10_rows';

    protected $fillable = [
        'Form10_id',
        'sektor_sub_sektor',
        'lokasi',
        'hasil_survey',
        'hasil_wawancara',
        'hasil_pendataan_skpd',
        'kebutuhan_pemulihan',
        'created_by',
        'updated_by'
    ];

    public function Form10()
    {
        return $this->belongsTo(Form10::class, 'Form10_id');
    }
}
