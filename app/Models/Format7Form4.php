<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Format7Form4 extends Model
{
    use SoftDeletes;

    protected $table = 'format7_form4s';

    protected $fillable = [
        'bencana_id',
        'nama_kampung',
        'nama_distrik',
        
        // Jalan
        'jalan_ruas',
        'jalan_jenis',
        'jalan_tipe',
        'jalan_rusak_berat',
        'jalan_rusak_sedang',
        'jalan_rusak_ringan',
        'jalan_harga_satuan',
        'jalan_biaya_perbaikan',
        
        // Jembatan
        'jembatan_nama',
        'jembatan_jenis',
        'jembatan_tipe',
        'jembatan_rusak_berat',
        'jembatan_rusak_sedang',
        'jembatan_rusak_ringan',
        'jembatan_harga_satuan',
        'jembatan_biaya_perbaikan',
        
        // Kerusakan Kendaraan
        'sedan_minibus_jumlah',
        'sedan_minibus_unit',
        'bus_truk_jumlah',
        'bus_truk_unit',
        'kendaraan_berat_jumlah',
        'kendaraan_berat_unit',
        'kapal_laut_jumlah',
        'kapal_laut_unit',
        'bus_air_jumlah',
        'bus_air_unit',
        'speed_boat_jumlah',
        'speed_boat_unit',
        'perahu_klotok_jumlah',
        'perahu_klotok_unit',
        
        // Prasarana Transportasi
        'terminal_jumlah',
        'terminal_rusak_berat',
        'terminal_rusak_sedang',
        'terminal_rusak_ringan',
        'terminal_biaya_perbaikan',
        'dermaga_jumlah',
        'dermaga_rusak_berat',
        'dermaga_rusak_sedang',
        'dermaga_rusak_ringan',
        'dermaga_biaya_perbaikan',
        'bandara_jumlah',
        'bandara_rusak_berat',
        'bandara_rusak_sedang',
        'bandara_rusak_ringan',
        'bandara_biaya_perbaikan',
        
        // Kehilangan Pendapatan
        'pendapatan_darat_per_hari',
        'jumlah_angkutan_darat_terdampak',
        'pendapatan_laut_per_hari',
        'jumlah_angkutan_laut_terdampak',
        'pendapatan_udara_per_hari',
        'jumlah_angkutan_udara_terdampak',
        'pendapatan_terminal_per_hari',
        'pendapatan_dermaga_per_hari',
        'pendapatan_bandara_per_hari',
        
        // Kenaikan Biaya Operasional
        'biaya_operasional_sebelum',
        'biaya_operasional_setelah',
        'jumlah_kendaraan_biaya_operasional',
        
        // Infrastruktur Darurat
        'infrastruktur_darurat_jumlah',
        'infrastruktur_darurat_biaya',
    ];

    protected $casts = [
        'bencana_id' => 'integer',
        
        // Jalan - kerusakan
        'jalan_rusak_berat' => 'decimal:2',
        'jalan_rusak_sedang' => 'decimal:2',
        'jalan_rusak_ringan' => 'decimal:2',
        'jalan_harga_satuan' => 'decimal:2',
        'jalan_biaya_perbaikan' => 'decimal:2',
        
        // Jembatan - kerusakan
        'jembatan_rusak_berat' => 'decimal:2',
        'jembatan_rusak_sedang' => 'decimal:2',
        'jembatan_rusak_ringan' => 'decimal:2',
        'jembatan_harga_satuan' => 'decimal:2',
        'jembatan_biaya_perbaikan' => 'decimal:2',
        
        // Kendaraan
        'sedan_minibus_jumlah' => 'integer',
        'sedan_minibus_unit' => 'integer',
        'bus_truk_jumlah' => 'integer',
        'bus_truk_unit' => 'integer',
        'kendaraan_berat_jumlah' => 'integer',
        'kendaraan_berat_unit' => 'integer',
        'kapal_laut_jumlah' => 'integer',
        'kapal_laut_unit' => 'integer',
        'bus_air_jumlah' => 'integer',
        'bus_air_unit' => 'integer',
        'speed_boat_jumlah' => 'integer',
        'speed_boat_unit' => 'integer',
        'perahu_klotok_jumlah' => 'integer',
        'perahu_klotok_unit' => 'integer',
        
        // Prasarana
        'terminal_jumlah' => 'integer',
        'terminal_rusak_berat' => 'integer',
        'terminal_rusak_sedang' => 'integer',
        'terminal_rusak_ringan' => 'integer',
        'terminal_biaya_perbaikan' => 'decimal:2',
        'dermaga_jumlah' => 'integer',
        'dermaga_rusak_berat' => 'integer',
        'dermaga_rusak_sedang' => 'integer',
        'dermaga_rusak_ringan' => 'integer',
        'dermaga_biaya_perbaikan' => 'decimal:2',
        'bandara_jumlah' => 'integer',
        'bandara_rusak_berat' => 'integer',
        'bandara_rusak_sedang' => 'integer',
        'bandara_rusak_ringan' => 'integer',
        'bandara_biaya_perbaikan' => 'decimal:2',
        
        // Pendapatan
        'pendapatan_darat_per_hari' => 'decimal:2',
        'jumlah_angkutan_darat_terdampak' => 'integer',
        'pendapatan_laut_per_hari' => 'decimal:2',
        'jumlah_angkutan_laut_terdampak' => 'integer',
        'pendapatan_udara_per_hari' => 'decimal:2',
        'jumlah_angkutan_udara_terdampak' => 'integer',
        'pendapatan_terminal_per_hari' => 'decimal:2',
        'pendapatan_dermaga_per_hari' => 'decimal:2',
        'pendapatan_bandara_per_hari' => 'decimal:2',
        
        // Biaya operasional
        'biaya_operasional_sebelum' => 'decimal:2',
        'biaya_operasional_setelah' => 'decimal:2',
        'jumlah_kendaraan_biaya_operasional' => 'integer',
        
        // Infrastruktur darurat
        'infrastruktur_darurat_jumlah' => 'integer',
        'infrastruktur_darurat_biaya' => 'decimal:2',
    ];

    protected $dates = [
        'deleted_at',
    ];

    /**
     * Relationship dengan Bencana
     */
    public function bencana(): BelongsTo
    {
        return $this->belongsTo(Bencana::class);
    }

    /**
     * Relationship dengan Rekap
     */
    public function rekap(): BelongsTo
    {
        return $this->belongsTo(Rekap::class, 'bencana_id', 'bencana_id');
    }

    /**
     * Calculate total kerusakan infrastruktur
     */
    public function getTotalKerusakanInfrastrukturAttribute()
    {
        return ($this->jalan_biaya_perbaikan ?? 0) +
               ($this->jembatan_biaya_perbaikan ?? 0) +
               ($this->terminal_biaya_perbaikan ?? 0) +
               ($this->dermaga_biaya_perbaikan ?? 0) +
               ($this->bandara_biaya_perbaikan ?? 0);
    }

    /**
     * Calculate total kehilangan pendapatan
     */
    public function getTotalKehilanganPendapatanAttribute()
    {
        return ($this->pendapatan_darat_per_hari ?? 0) +
               ($this->pendapatan_laut_per_hari ?? 0) +
               ($this->pendapatan_udara_per_hari ?? 0) +
               ($this->pendapatan_terminal_per_hari ?? 0) +
               ($this->pendapatan_dermaga_per_hari ?? 0) +
               ($this->pendapatan_bandara_per_hari ?? 0);
    }

    /**
     * Calculate total kenaikan biaya operasional
     */
    public function getTotalKenaikanBiayaOperasionalAttribute()
    {
        $selisih_biaya = ($this->biaya_operasional_setelah ?? 0) - ($this->biaya_operasional_sebelum ?? 0);
        return $selisih_biaya * ($this->jumlah_kendaraan_biaya_operasional ?? 0);
    }

    /**
     * Calculate total biaya infrastruktur darurat
     */
    public function getTotalBiayaInfrastrukturDaruratAttribute()
    {
        return ($this->infrastruktur_darurat_jumlah ?? 0) * ($this->infrastruktur_darurat_biaya ?? 0);
    }

    /**
     * Calculate grand total kerusakan + kerugian
     */
    public function getGrandTotalAttribute()
    {
        return $this->total_kerusakan_infrastruktur +
               $this->total_kehilangan_pendapatan +
               $this->total_kenaikan_biaya_operasional +
               $this->total_biaya_infrastruktur_darurat;
    }
}
