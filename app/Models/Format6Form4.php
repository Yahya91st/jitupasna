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
        'struktur_air_unit', 'struktur_air_jumlah', 'struktur_air_harga_satuan', 'struktur_air_total',
        'instalasi_pemurnian_unit', 'instalasi_pemurnian_jumlah', 'instalasi_pemurnian_harga_satuan', 'instalasi_pemurnian_total',
        'perpipaan_unit', 'perpipaan_jumlah', 'perpipaan_harga_satuan', 'perpipaan_total',
        'penyimpanan_unit', 'penyimpanan_jumlah', 'penyimpanan_harga_satuan', 'penyimpanan_total',
        'sumur_unit', 'sumur_jumlah', 'sumur_harga_satuan', 'sumur_total',
        'mck_unit', 'mck_jumlah', 'mck_harga_satuan', 'mck_total',
        // Sistem Sanitasi
        'sanitasi_unit', 'sanitasi_jumlah', 'sanitasi_harga_satuan', 'sanitasi_total',
        'drainase_unit', 'drainase_jumlah', 'drainase_harga_satuan', 'drainase_total',
        'limbah_padat_unit', 'limbah_padat_jumlah', 'limbah_padat_harga_satuan', 'limbah_padat_total',
        'wc_umum_unit', 'wc_umum_jumlah', 'wc_umum_harga_satuan', 'wc_umum_total',
        // Perkiraan Kerugian
        'kehilangan_pendapatan_pdam',
        'biaya_pemurnian', 'dasar_perhitungan_biaya_pemurnian',
        'biaya_distribusi', 'dasar_perhitungan_biaya_distribusi',
        'biaya_pembersihan', 'dasar_perhitungan_biaya_pembersihan',
        'biaya_lain', 'dasar_perhitungan_biaya_lain',
        'sanitasi_pendapatan',
        'biaya_pembersihan_jaringan', 'dasar_perhitungan_biaya_pembersihan_jaringan',
        'biaya_bahan_kimia', 'dasar_perhitungan_biaya_bahan_kimia',
        'total_kerusakan', 'total_kerugian',
    ];

    protected $casts = [
        // Unit fields are strings (no casting needed)
        'struktur_air_jumlah' => 'integer', 'struktur_air_harga_satuan' => 'decimal:2', 'struktur_air_total' => 'decimal:2',
        'instalasi_pemurnian_jumlah' => 'integer', 'instalasi_pemurnian_harga_satuan' => 'decimal:2', 'instalasi_pemurnian_total' => 'decimal:2',
        'perpipaan_jumlah' => 'integer', 'perpipaan_harga_satuan' => 'decimal:2', 'perpipaan_total' => 'decimal:2',
        'penyimpanan_jumlah' => 'integer', 'penyimpanan_harga_satuan' => 'decimal:2', 'penyimpanan_total' => 'decimal:2',
        'sumur_jumlah' => 'integer', 'sumur_harga_satuan' => 'decimal:2', 'sumur_total' => 'decimal:2',
        'mck_jumlah' => 'integer', 'mck_harga_satuan' => 'decimal:2', 'mck_total' => 'decimal:2',
        'sanitasi_jumlah' => 'integer', 'sanitasi_harga_satuan' => 'decimal:2', 'sanitasi_total' => 'decimal:2',
        'drainase_jumlah' => 'integer', 'drainase_harga_satuan' => 'decimal:2', 'drainase_total' => 'decimal:2',
        'limbah_padat_jumlah' => 'integer', 'limbah_padat_harga_satuan' => 'decimal:2', 'limbah_padat_total' => 'decimal:2',
        'wc_umum_jumlah' => 'integer', 'wc_umum_harga_satuan' => 'decimal:2', 'wc_umum_total' => 'decimal:2',
        'kehilangan_pendapatan_pdam' => 'decimal:2',
        'biaya_pemurnian' => 'decimal:2', 'biaya_distribusi' => 'decimal:2', 'biaya_pembersihan' => 'decimal:2', 'biaya_lain' => 'decimal:2',
        'sanitasi_pendapatan' => 'decimal:2', 'biaya_pembersihan_jaringan' => 'decimal:2', 'biaya_bahan_kimia' => 'decimal:2',
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
               ($this->biaya_pemurnian ?? 0) +
               ($this->biaya_distribusi ?? 0) +
               ($this->biaya_pembersihan ?? 0) +
               ($this->biaya_lain ?? 0) +
               ($this->sanitasi_pendapatan ?? 0) +
               ($this->biaya_pembersihan_jaringan ?? 0) +
               ($this->biaya_bahan_kimia ?? 0);
    }

    /**
     * Total kerusakan air minum (dinamis: jumlah * harga)
     */
    public function getTotalKerusakanAirMinumAttribute()
    {
        return ($this->struktur_air_jumlah ?? 0) * ($this->struktur_air_harga_satuan ?? 0)
            + ($this->instalasi_pemurnian_jumlah ?? 0) * ($this->instalasi_pemurnian_harga_satuan ?? 0)
            + ($this->perpipaan_jumlah ?? 0) * ($this->perpipaan_harga_satuan ?? 0)
            + ($this->penyimpanan_jumlah ?? 0) * ($this->penyimpanan_harga_satuan ?? 0)
            + ($this->sumur_jumlah ?? 0) * ($this->sumur_harga_satuan ?? 0)
            + ($this->mck_jumlah ?? 0) * ($this->mck_harga_satuan ?? 0);
    }

    /**
     * Total kerusakan sanitasi (dinamis: jumlah * harga)
     */
    public function getTotalKerusakanSanitasiAttribute()
    {
        return ($this->sanitasi_jumlah ?? 0) * ($this->sanitasi_harga_satuan ?? 0)
            + ($this->drainase_jumlah ?? 0) * ($this->drainase_harga_satuan ?? 0)
            + ($this->limbah_padat_jumlah ?? 0) * ($this->limbah_padat_harga_satuan ?? 0)
            + ($this->wc_umum_jumlah ?? 0) * ($this->wc_umum_harga_satuan ?? 0);
    }

    protected static function boot()
    {
        parent::boot();
        static::saving(function ($format6) {
            // Auto calculate total for each item (jumlah × harga_satuan)
            $format6->struktur_air_total = ($format6->struktur_air_jumlah ?? 0) * ($format6->struktur_air_harga_satuan ?? 0);
            $format6->instalasi_pemurnian_total = ($format6->instalasi_pemurnian_jumlah ?? 0) * ($format6->instalasi_pemurnian_harga_satuan ?? 0);
            $format6->perpipaan_total = ($format6->perpipaan_jumlah ?? 0) * ($format6->perpipaan_harga_satuan ?? 0);
            $format6->penyimpanan_total = ($format6->penyimpanan_jumlah ?? 0) * ($format6->penyimpanan_harga_satuan ?? 0);
            $format6->sumur_total = ($format6->sumur_jumlah ?? 0) * ($format6->sumur_harga_satuan ?? 0);
            $format6->mck_total = ($format6->mck_jumlah ?? 0) * ($format6->mck_harga_satuan ?? 0);
            $format6->sanitasi_total = ($format6->sanitasi_jumlah ?? 0) * ($format6->sanitasi_harga_satuan ?? 0);
            $format6->drainase_total = ($format6->drainase_jumlah ?? 0) * ($format6->drainase_harga_satuan ?? 0);
            $format6->limbah_padat_total = ($format6->limbah_padat_jumlah ?? 0) * ($format6->limbah_padat_harga_satuan ?? 0);
            $format6->wc_umum_total = ($format6->wc_umum_jumlah ?? 0) * ($format6->wc_umum_harga_satuan ?? 0);

            // Calculate total kerusakan (air minum + sanitasi)
            $totalAirMinum = $format6->struktur_air_total + $format6->instalasi_pemurnian_total + $format6->perpipaan_total + 
                           $format6->penyimpanan_total + $format6->sumur_total + $format6->mck_total;
            $totalSanitasi = $format6->sanitasi_total + $format6->drainase_total + $format6->limbah_padat_total + $format6->wc_umum_total;
            $format6->total_kerusakan = $totalAirMinum + $totalSanitasi;

            // Calculate total kerugian
            $format6->total_kerugian = ($format6->kehilangan_pendapatan_pdam ?? 0) +
                                     ($format6->biaya_pemurnian ?? 0) +
                                     ($format6->biaya_distribusi ?? 0) +
                                     ($format6->biaya_pembersihan ?? 0) +
                                     ($format6->biaya_lain ?? 0) +
                                     ($format6->sanitasi_pendapatan ?? 0) +
                                     ($format6->biaya_pembersihan_jaringan ?? 0) +
                                     ($format6->biaya_bahan_kimia ?? 0);
        });
    }
}
