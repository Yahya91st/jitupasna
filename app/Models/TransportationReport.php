<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransportationReport extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'bencana_id',
        'report_type',
        'rusak_berat',
        'rusak_sedang',
        'rusak_ringan',
        'harga_satuan',
        'biaya_total',
        
        // Jalan (Road) specific fields
        'ruas_jalan',
        'status_jalan',
        'jenis_jalan',
        
        // Jembatan (Bridge) specific fields
        'nama_jembatan',
        'status_jembatan',
        'jenis_jembatan',
        
        // Kendaraan (Vehicle) specific fields
        'jenis_kendaraan',
        'moda',
        
        // Prasarana (Infrastructure) specific fields
        'jenis_prasarana',
        'tipe_prasarana',
        'luas_prasarana',
        
        // Pendapatan (Revenue) specific fields
        'pendapatan_per_hari',
        'jumlah_terdampak',
        'jumlah_hari',
        
        // Operasional (Operational costs) specific fields
        'biaya_sebelum',
        'biaya_sesudah',
        'jumlah_kendaraan',
        'jarak_tempuh',
        'durasi',
        
        // Infrastruktur Darurat (Emergency infrastructure) specific fields
        'jenis_infrastruktur_darurat',
        'jumlah_unit',
        'biaya_per_unit',
        
        // Additional metadata fields
        'catatan',
    ];

    /**
     * Get the bencana that owns the transportation report.
     */
    public function bencana()
    {
        return $this->belongsTo(Bencana::class);
    }
}