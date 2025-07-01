<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Format6Form4 extends Model
{
    use SoftDeletes;

    protected $table = 'format6_form4s';

    protected $fillable = [
        'bencana_id',
        'nama_kampung',
        'nama_distrik',
        
        // Sarana Air Minum
        'struktur_air_jumlah',
        'struktur_air_harga',
        'struktur_air_total',
        'instalasi_pemurnian_jumlah',
        'instalasi_pemurnian_harga',
        'instalasi_pemurnian_total',
        'perpipaan_jumlah',
        'perpipaan_harga',
        'perpipaan_total',
        'penyimpanan_jumlah',
        'penyimpanan_harga',
        'penyimpanan_total',
        'sumur_jumlah',
        'sumur_harga',
        'sumur_total',
        'mck_jumlah',
        'mck_harga',
        'mck_total',
        
        // Sistem Sanitasi
        'sanitasi_jumlah',
        'sanitasi_harga',
        'sanitasi_total',
        'drainase_jumlah',
        'drainase_harga',
        'drainase_total',
        'limbah_padat_jumlah',
        'limbah_padat_harga',
        'limbah_padat_total',
        'wc_umum_jumlah',
        'wc_umum_harga',
        'wc_umum_total',
        
        // Perkiraan Kerugian
        'kehilangan_pendapatan_pdam',
        'biaya_pemurnian_air',
        'biaya_distribusi_air',
        'biaya_pembersihan_sumur',
        'biaya_lain_air',
        'biaya_sanitasi_lain',
    ];

    protected $casts = [
        'bencana_id' => 'integer',
        
        // Sarana Air Minum
        'struktur_air_jumlah' => 'integer',
        'struktur_air_harga' => 'decimal:2',
        'struktur_air_total' => 'decimal:2',
        'instalasi_pemurnian_jumlah' => 'integer',
        'instalasi_pemurnian_harga' => 'decimal:2',
        'instalasi_pemurnian_total' => 'decimal:2',
        'perpipaan_jumlah' => 'integer',
        'perpipaan_harga' => 'decimal:2',
        'perpipaan_total' => 'decimal:2',
        'penyimpanan_jumlah' => 'integer',
        'penyimpanan_harga' => 'decimal:2',
        'penyimpanan_total' => 'decimal:2',
        'sumur_jumlah' => 'integer',
        'sumur_harga' => 'decimal:2',
        'sumur_total' => 'decimal:2',
        'mck_jumlah' => 'integer',
        'mck_harga' => 'decimal:2',
        'mck_total' => 'decimal:2',
        
        // Sistem Sanitasi
        'sanitasi_jumlah' => 'integer',
        'sanitasi_harga' => 'decimal:2',
        'sanitasi_total' => 'decimal:2',
        'drainase_jumlah' => 'integer',
        'drainase_harga' => 'decimal:2',
        'drainase_total' => 'decimal:2',
        'limbah_padat_jumlah' => 'integer',
        'limbah_padat_harga' => 'decimal:2',
        'limbah_padat_total' => 'decimal:2',
        'wc_umum_jumlah' => 'integer',
        'wc_umum_harga' => 'decimal:2',
        'wc_umum_total' => 'decimal:2',
        
        // Perkiraan Kerugian
        'kehilangan_pendapatan_pdam' => 'decimal:2',
        'biaya_pemurnian_air' => 'decimal:2',
        'biaya_distribusi_air' => 'decimal:2',
        'biaya_pembersihan_sumur' => 'decimal:2',
        'biaya_lain_air' => 'decimal:2',
        'biaya_sanitasi_lain' => 'decimal:2',
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
     * Calculate total kerusakan sarana air minum
     */
    public function getTotalKerusakanAirMinumAttribute()
    {
        return ($this->struktur_air_total ?? 0) +
               ($this->instalasi_pemurnian_total ?? 0) +
               ($this->perpipaan_total ?? 0) +
               ($this->penyimpanan_total ?? 0) +
               ($this->sumur_total ?? 0) +
               ($this->mck_total ?? 0);
    }

    /**
     * Calculate total kerusakan sistem sanitasi
     */
    public function getTotalKerusakanSanitasiAttribute()
    {
        return ($this->sanitasi_total ?? 0) +
               ($this->drainase_total ?? 0) +
               ($this->limbah_padat_total ?? 0) +
               ($this->wc_umum_total ?? 0);
    }

    /**
     * Calculate total perkiraan kerugian
     */
    public function getTotalKerugianAttribute()
    {
        return ($this->kehilangan_pendapatan_pdam ?? 0) +
               ($this->biaya_pemurnian_air ?? 0) +
               ($this->biaya_distribusi_air ?? 0) +
               ($this->biaya_pembersihan_sumur ?? 0) +
               ($this->biaya_lain_air ?? 0) +
               ($this->biaya_sanitasi_lain ?? 0);
    }

    /**
     * Calculate grand total kerusakan + kerugian
     */
    public function getGrandTotalAttribute()
    {
        return $this->total_kerusakan_air_minum + $this->total_kerusakan_sanitasi + $this->total_kerugian;
    }
}
