<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Form3Row_1 extends Model
{
    protected $table = 'form3_rows_1';
    protected $fillable = ['form3_id','kategori','sub_kategori','jawaban'];

    public function form3()
    {
        return $this->belongsTo(Form3::class, 'form8_id');
    }
}