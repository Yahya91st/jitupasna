<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Format6Form4 extends Model
{
    protected $table = 'format6_form4s';

    protected $fillable = [
        'bencana_id',
        'nama_kampung',
        'nama_distrik',
        // Sarana Air Minum
        'struktur_air_unit', 'struktur_air_harga', 'struktur_air_total',
        'instalasi_pemurnian_unit', 'instalasi_pemurnian_harga', 'instalasi_pemurnian_total',
        'perpipaan_unit', 'perpipaan_harga', 'perpipaan_total',
        'penyimpanan_unit', 'penyimpanan_harga', 'penyimpanan_total',
        'sumur_unit', 'sumur_harga', 'sumur_total',
        'mck_unit', 'mck_harga', 'mck_total',
        // Sistem Sanitasi
        'sanitasi_unit', 'sanitasi_harga', 'sanitasi_total',
        'drainase_unit', 'drainase_harga', 'drainase_total',
        'limbah_padat_unit', 'limbah_padat_harga', 'limbah_padat_total',
        'wc_umum_unit', 'wc_umum_harga', 'wc_umum_total',
        // Perkiraan Kerugian
        'kehilangan_pendapatan_pdam', 'biaya_pemurnian_air', 'biaya_distribusi_air', 'biaya_pembersihan_sumur', 'biaya_lain_air', 'biaya_sanitasi_lain',
        'total_kerusakan', 'total_kerugian',
    ];

    protected $casts = [
        'struktur_air_unit' => 'integer', 'struktur_air_harga' => 'decimal:2', 'struktur_air_total' => 'decimal:2',
        'instalasi_pemurnian_unit' => 'integer', 'instalasi_pemurnian_harga' => 'decimal:2', 'instalasi_pemurnian_total' => 'decimal:2',
        'perpipaan_unit' => 'integer', 'perpipaan_harga' => 'decimal:2', 'perpipaan_total' => 'decimal:2',
        'penyimpanan_unit' => 'integer', 'penyimpanan_harga' => 'decimal:2', 'penyimpanan_total' => 'decimal:2',
        'sumur_unit' => 'integer', 'sumur_harga' => 'decimal:2', 'sumur_total' => 'decimal:2',
        'mck_unit' => 'integer', 'mck_harga' => 'decimal:2', 'mck_total' => 'decimal:2',
        'sanitasi_unit' => 'integer', 'sanitasi_harga' => 'decimal:2', 'sanitasi_total' => 'decimal:2',
        'drainase_unit' => 'integer', 'drainase_harga' => 'decimal:2', 'drainase_total' => 'decimal:2',
        'limbah_padat_unit' => 'integer', 'limbah_padat_harga' => 'decimal:2', 'limbah_padat_total' => 'decimal:2',
        'wc_umum_unit' => 'integer', 'wc_umum_harga' => 'decimal:2', 'wc_umum_total' => 'decimal:2',
        'kehilangan_pendapatan_pdam' => 'decimal:2', 'biaya_pemurnian_air' => 'decimal:2', 'biaya_distribusi_air' => 'decimal:2', 'biaya_pembersihan_sumur' => 'decimal:2', 'biaya_lain_air' => 'decimal:2', 'biaya_sanitasi_lain' => 'decimal:2',
        'total_kerusakan' => 'decimal:2', 'total_kerugian' => 'decimal:2',
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

    /**
     * Total kerusakan air minum (dinamis: jumlah * harga)
     */
    public function getTotalKerusakanAirMinumAttribute()
    {
        return ($this->struktur_air_unit ?? 0) * ($this->struktur_air_harga ?? 0)
            + ($this->instalasi_pemurnian_unit ?? 0) * ($this->instalasi_pemurnian_harga ?? 0)
            + ($this->perpipaan_unit ?? 0) * ($this->perpipaan_harga ?? 0)
            + ($this->penyimpanan_unit ?? 0) * ($this->penyimpanan_harga ?? 0)
            + ($this->sumur_unit ?? 0) * ($this->sumur_harga ?? 0)
            + ($this->mck_unit ?? 0) * ($this->mck_harga ?? 0);
    }

    /**
     * Total kerusakan sanitasi (dinamis: jumlah * harga)
     */
    public function getTotalKerusakanSanitasiAttribute()
    {
        return ($this->sanitasi_unit ?? 0) * ($this->sanitasi_harga ?? 0)
            + ($this->drainase_unit ?? 0) * ($this->drainase_harga ?? 0)
            + ($this->limbah_padat_unit ?? 0) * ($this->limbah_padat_harga ?? 0)
            + ($this->wc_umum_unit ?? 0) * ($this->wc_umum_harga ?? 0);
    }

    protected static function boot()
    {
        parent::boot();
        static::saving(function ($model) {
            $model->struktur_air_total = ($model->struktur_air_unit ?? 0) * ($model->struktur_air_harga ?? 0);
            $model->instalasi_pemurnian_total = ($model->instalasi_pemurnian_unit ?? 0) * ($model->instalasi_pemurnian_harga ?? 0);
            $model->perpipaan_total = ($model->perpipaan_unit ?? 0) * ($model->perpipaan_harga ?? 0);
            $model->penyimpanan_total = ($model->penyimpanan_unit ?? 0) * ($model->penyimpanan_harga ?? 0);
            $model->sumur_total = ($model->sumur_unit ?? 0) * ($model->sumur_harga ?? 0);
            $model->mck_total = ($model->mck_unit ?? 0) * ($model->mck_harga ?? 0);
            $model->sanitasi_total = ($model->sanitasi_unit ?? 0) * ($model->sanitasi_harga ?? 0);
            $model->drainase_total = ($model->drainase_unit ?? 0) * ($model->drainase_harga ?? 0);
            $model->limbah_padat_total = ($model->limbah_padat_unit ?? 0) * ($model->limbah_padat_harga ?? 0);
            $model->wc_umum_total = ($model->wc_umum_unit ?? 0) * ($model->wc_umum_harga ?? 0);

            // Simpan total kerusakan (air minum + sanitasi)
            $model->total_kerusakan = $model->total_kerusakan_air_minum + $model->total_kerusakan_sanitasi;
        });
    }
}
