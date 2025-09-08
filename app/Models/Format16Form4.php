<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Format16Form4 extends Model
{
    protected $table = 'format16_form4s';
    protected $fillable = [
        'bencana_id',
        'kabupaten',
        'nama_kampung',
        'nama_distrik',
        // Kantor Pemkab
        'kantor_pemkab_berat', 'kantor_pemkab_sedang', 'kantor_pemkab_ringan',
        'kantor_pemkab_rb_harga', 'kantor_pemkab_rs_harga', 'kantor_pemkab_rr_harga',
        // Kantor Kecamatan
        'kantor_kecamatan_berat', 'kantor_kecamatan_sedang', 'kantor_kecamatan_ringan',
        'kantor_kecamatan_rb_harga', 'kantor_kecamatan_rs_harga', 'kantor_kecamatan_rr_harga',
        // Kantor Dinas
        'kantor_dinas_berat', 'kantor_dinas_sedang', 'kantor_dinas_ringan',
        'kantor_dinas_rb_harga', 'kantor_dinas_rs_harga', 'kantor_dinas_rr_harga',
        // Kantor Instansi Vertikal
        'kantor_vertikal_berat', 'kantor_vertikal_sedang', 'kantor_vertikal_ringan',
        'kantor_vertikal_rb_harga', 'kantor_vertikal_rs_harga', 'kantor_vertikal_rr_harga',
        // Mebelair dan Peralatan Kantor
        'mebelair_berat', 'mebelair_sedang', 'mebelair_ringan',
        'mebelair_rb_harga', 'mebelair_rs_harga', 'mebelair_rr_harga',
        // Biaya Pembersihan Puing
        'biaya_tenaga_kerja_hok', 'upah_harian', 'biaya_alat_berat_hari', 'biaya_alat_berat_tarif',
        // Biaya Sewa Kantor Sementara
        'sewa_kantor_jumlah_unit', 'sewa_kantor_biaya_per_unit',
        // Biaya Restorasi Arsip
        'restorasi_arsip_jumlah', 'restorasi_arsip_harga_satuan',
        // Kehilangan Pendapatan Retribusi
        'dasar_perhitungan_retribusi',
    ];
    protected $casts = [
        // Kantor Pemkab
        'kantor_pemkab_berat' => 'integer', 'kantor_pemkab_sedang' => 'integer', 'kantor_pemkab_ringan' => 'integer',
        'kantor_pemkab_rb_harga' => 'decimal:2', 'kantor_pemkab_rs_harga' => 'decimal:2', 'kantor_pemkab_rr_harga' => 'decimal:2',
        // Kantor Kecamatan
        'kantor_kecamatan_berat' => 'integer', 'kantor_kecamatan_sedang' => 'integer', 'kantor_kecamatan_ringan' => 'integer',
        'kantor_kecamatan_rb_harga' => 'decimal:2', 'kantor_kecamatan_rs_harga' => 'decimal:2', 'kantor_kecamatan_rr_harga' => 'decimal:2',
        // Kantor Dinas
        'kantor_dinas_berat' => 'integer', 'kantor_dinas_sedang' => 'integer', 'kantor_dinas_ringan' => 'integer',
        'kantor_dinas_rb_harga' => 'decimal:2', 'kantor_dinas_rs_harga' => 'decimal:2', 'kantor_dinas_rr_harga' => 'decimal:2',
        // Kantor Instansi Vertikal
        'kantor_vertikal_berat' => 'integer', 'kantor_vertikal_sedang' => 'integer', 'kantor_vertikal_ringan' => 'integer',
        'kantor_vertikal_rb_harga' => 'decimal:2', 'kantor_vertikal_rs_harga' => 'decimal:2', 'kantor_vertikal_rr_harga' => 'decimal:2',
        // Mebelair dan Peralatan Kantor
        'mebelair_berat' => 'integer', 'mebelair_sedang' => 'integer', 'mebelair_ringan' => 'integer',
        'mebelair_rb_harga' => 'decimal:2', 'mebelair_rs_harga' => 'decimal:2', 'mebelair_rr_harga' => 'decimal:2',
        // Biaya Pembersihan Puing
        'biaya_tenaga_kerja_hok' => 'integer', 'upah_harian' => 'decimal:2', 'biaya_alat_berat_hari' => 'integer', 'biaya_alat_berat_tarif' => 'decimal:2',
        // Biaya Sewa Kantor Sementara
        'sewa_kantor_jumlah_unit' => 'integer', 'sewa_kantor_biaya_per_unit' => 'decimal:2',
        // Biaya Restorasi Arsip
        'restorasi_arsip_jumlah' => 'integer', 'restorasi_arsip_harga_satuan' => 'decimal:2',
    ];

    // Hitung total kerusakan
    public function getTotalKerusakanAttribute()
    {
        return
            ($this->kantor_pemkab_berat * $this->kantor_pemkab_rb_harga) +
            ($this->kantor_pemkab_sedang * $this->kantor_pemkab_rs_harga) +
            ($this->kantor_pemkab_ringan * $this->kantor_pemkab_rr_harga) +
            ($this->kantor_kecamatan_berat * $this->kantor_kecamatan_rb_harga) +
            ($this->kantor_kecamatan_sedang * $this->kantor_kecamatan_rs_harga) +
            ($this->kantor_kecamatan_ringan * $this->kantor_kecamatan_rr_harga) +
            ($this->kantor_dinas_berat * $this->kantor_dinas_rb_harga) +
            ($this->kantor_dinas_sedang * $this->kantor_dinas_rs_harga) +
            ($this->kantor_dinas_ringan * $this->kantor_dinas_rr_harga) +
            ($this->kantor_vertikal_berat * $this->kantor_vertikal_rb_harga) +
            ($this->kantor_vertikal_sedang * $this->kantor_vertikal_rs_harga) +
            ($this->kantor_vertikal_ringan * $this->kantor_vertikal_rr_harga) +
            ($this->mebelair_berat * $this->mebelair_rb_harga) +
            ($this->mebelair_sedang * $this->mebelair_rs_harga) +
            ($this->mebelair_ringan * $this->mebelair_rr_harga);
    }

    // Simpan total_kerusakan ke database jika field tersedia
    protected static function booted()
    {
        static::saving(function ($format16) {
            $format16->total_kerusakan = $format16->getTotalKerusakanAttribute();
        });
    }

    /**
     * Get the bencana that owns the Format16Form4.
     */
    public function bencana(): BelongsTo
    {
        return $this->belongsTo(Bencana::class);
    }
}
