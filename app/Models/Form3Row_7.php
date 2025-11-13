<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Form3Row_7 extends Model
{
    protected $table = 'form3_rows_7';

    protected $fillable = [
        'form3_id',
    ];

    public function form3()
    {
        return $this->belongsTo(Form3::class, 'form8_id');
    }
}