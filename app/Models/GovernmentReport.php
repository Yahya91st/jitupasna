<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GovernmentReport extends Model
{
    protected $fillable = [
        'bencana_id',
        // Damage fields
        'jenis_fasilitas',
        'jumlah_rb',
        'jumlah_rs',
        'jumlah_rr',
        'harga_rb',
        'harga_rs',
        'harga_rr',
        // Loss fields
        'tenaga_kerja_hok',
        'upah_harian',
        'alat_berat_hari',
        'biaya_per_hari_alat_berat',
        'jumlah_unit',
        'biaya_sewa_per_unit',
        'jumlah_arsip',
        'harga_satuan',
        'dasar_perhitungan',
    ];

    public function bencana()
    {
        return $this->belongsTo(Bencana::class);
    }

    // Calculate total damage for the record
    public function getTotalDamage()
    {
        return ($this->jumlah_rb * $this->harga_rb) + 
               ($this->jumlah_rs * $this->harga_rs) + 
               ($this->jumlah_rr * $this->harga_rr);
    }

    // Calculate total loss for the record
    public function getTotalLoss()
    {
        $puingLoss = ($this->tenaga_kerja_hok * $this->upah_harian) + 
                    ($this->alat_berat_hari * $this->biaya_per_hari_alat_berat);
        
        $kantorLoss = $this->jumlah_unit * $this->biaya_sewa_per_unit;
        
        $arsipLoss = $this->jumlah_arsip * $this->harga_satuan;
        
        return $puingLoss + $kantorLoss + $arsipLoss;
    }
}