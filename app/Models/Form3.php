<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Form3 extends Model
{
    use HasFactory;
    
    protected $table = 'form3';
    
    protected $fillable = [
        'bencana_id',
        'tanggal',
        'keterangan',    
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
    public function rows_1()
    {
        return $this->hasMany(Form3Row_1::class, 'form3_id');
    }

    public function rows_2()
    {
        return $this->hasMany(Form3Row_2::class, 'form3_id');
    }

    public function rows_3()
    {
        return $this->hasMany(Form3Row_3::class, 'form3_id');
    }

    public function rows_4()
    {
        return $this->hasMany(Form3Row_4::class, 'form3_id');
    }

    public function rows_5()
    {
        return $this->hasMany(Form3Row_5::class, 'form3_id');
    }

    public function rows_6()
    {
        return $this->hasMany(Form3Row_6::class, 'form3_id');
    }

    public function rows_7()
    {
        return $this->hasMany(Form3Row_7::class, 'form3_id');
    }

    public function rows_8()
    {
        return $this->hasMany(Form3Row_8::class, 'form3_id');
    }
}
