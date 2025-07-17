<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Format8Form4 extends Model
{
    protected $table = 'format8_form4s';

    protected $fillable = [
        'bencana_id',
        'nama_kampung',
        'nama_distrik',
        // Sistem Transmisi dan Distribusi
        'kabel_unit', 'kabel_harga_satuan', 'kabel_jumlah',
        'tiang_unit', 'tiang_harga_satuan', 'tiang_jumlah',
        'trafo_unit', 'trafo_harga_satuan', 'trafo_jumlah',
        // Sistem Pembangkitan
        'plta_unit', 'plta_harga_satuan', 'plta_jumlah',
        'pltu_unit', 'pltu_harga_satuan', 'pltu_jumlah',
        'pltd_unit', 'pltd_harga_satuan', 'pltd_jumlah',
        'pembangkit_lain_unit', 'pembangkit_lain_harga_satuan', 'pembangkit_lain_jumlah', 'pembangkit_lain_keterangan',
        // Perkiraan Jangka Waktu Pemulihan
        'jangka_waktu_pemulihan_bulan',
        // Pembangkit Listrik Darurat
        'genset_unit', 'genset_biaya_pengadaan', 'biaya_genset_total',
        // Perkiraan Kehilangan/Penurunan Pendapatan
        'permintaan_listrik_sebelum_kwh', 'permintaan_listrik_pasca_kwh', 'tarif_listrik_per_kwh', 'penurunan_pendapatan',
        // Perkiraan Kenaikan Biaya Operasional
        'biaya_operasional_sebelum', 'biaya_operasional_pasca', 'kenaikan_biaya_operasional',
    ];

    protected $casts = [
        'bencana_id' => 'integer',
        'kabel_unit' => 'decimal:2', 'kabel_harga_satuan' => 'decimal:2', 'kabel_jumlah' => 'decimal:2',
        'tiang_unit' => 'integer', 'tiang_harga_satuan' => 'decimal:2', 'tiang_jumlah' => 'decimal:2',
        'trafo_unit' => 'integer', 'trafo_harga_satuan' => 'decimal:2', 'trafo_jumlah' => 'decimal:2',
        'plta_unit' => 'integer', 'plta_harga_satuan' => 'decimal:2', 'plta_jumlah' => 'decimal:2',
        'pltu_unit' => 'integer', 'pltu_harga_satuan' => 'decimal:2', 'pltu_jumlah' => 'decimal:2',
        'pltd_unit' => 'integer', 'pltd_harga_satuan' => 'decimal:2', 'pltd_jumlah' => 'decimal:2',
        'pembangkit_lain_unit' => 'integer', 'pembangkit_lain_harga_satuan' => 'decimal:2', 'pembangkit_lain_jumlah' => 'decimal:2',
        'jangka_waktu_pemulihan_bulan' => 'integer',
        'genset_unit' => 'integer', 'genset_biaya_pengadaan' => 'decimal:2', 'biaya_genset_total' => 'decimal:2',
        'permintaan_listrik_sebelum_kwh' => 'decimal:2', 'permintaan_listrik_pasca_kwh' => 'decimal:2', 'tarif_listrik_per_kwh' => 'decimal:2', 'penurunan_pendapatan' => 'decimal:2',
        'biaya_operasional_sebelum' => 'decimal:2', 'biaya_operasional_pasca' => 'decimal:2', 'kenaikan_biaya_operasional' => 'decimal:2',
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
     * Calculate total kerusakan sistem transmisi dan distribusi
     */
    public function getTotalKerusakanTransmisiDistribusiAttribute()
    {
        $total_kabel = (($this->kabel_unit ?? 0) + ($this->kabel_jumlah ?? 0) + ($this->kabel_ ?? 0)) * ($this->kabel_harga_satuan ?? 0);
        $total_tiang = (($this->tiang_unit ?? 0) + ($this->tiang_jumlah ?? 0) + ($this->tiang_ ?? 0)) * ($this->tiang_harga_satuan ?? 0);
        $total_trafo = (($this->trafo_unit ?? 0) + ($this->trafo_jumlah ?? 0) + ($this->trafo_ ?? 0)) * ($this->trafo_harga_satuan ?? 0);
        
        return $total_kabel + $total_tiang + $total_trafo;
    }

    /**
     * Calculate total kerusakan sistem pembangkitan
     */
    public function getTotalKerusakanPembangkitanAttribute()
    {
        $total_plta = (($this->plta_unit ?? 0) + ($this->plta_jumlah ?? 0) + ($this->plta_ ?? 0)) * ($this->plta_harga_satuan ?? 0);
        $total_pltu = (($this->pltu_unit ?? 0) + ($this->pltu_jumlah ?? 0) + ($this->pltu_ ?? 0)) * ($this->pltu_harga_satuan ?? 0);
        $total_pltd = (($this->pltd_unit ?? 0) + ($this->pltd_jumlah ?? 0) + ($this->pltd_ ?? 0)) * ($this->pltd_harga_satuan ?? 0);
        $total_lain = (($this->pembangkit_lain_unit ?? 0) + ($this->pembangkit_lain_jumlah ?? 0) + ($this->pembangkit_lain_ ?? 0)) * ($this->pembangkit_lain_harga_satuan ?? 0);
        
        return $total_plta + $total_pltu + $total_pltd + $total_lain;
    }

    /**
     * Calculate total biaya genset darurat
     */
    public function getTotalBiayaGensetAttribute()
    {
        return ($this->genset_unit ?? 0) * ($this->genset_biaya_pengadaan ?? 0);
    }

    /**
     * Calculate total kehilangan pendapatan
     */
    public function getTotalKehilanganPendapatanAttribute()
    {
        return $this->penurunan_pendapatan ?? 0;
    }

    /**
     * Calculate total kenaikan biaya operasional
     */
    public function getTotalKenaikanBiayaOperasionalAttribute()
    {
        return $this->kenaikan_biaya_operasional ?? 0;
    }

    /**
     * Calculate grand total kerusakan + kerugian
     */
    public function getGrandTotalAttribute()
    {
        return $this->total_kerusakan_transmisi_distribusi +
               $this->total_kerusakan_pembangkitan +
               $this->total_biaya_genset +
               $this->total_kehilangan_pendapatan +
               $this->total_kenaikan_biaya_operasional;
    }

    /**
     * Total kerusakan (semua *_jumlah + biaya_genset_total)
     */
    public function getTotalKerusakanAttribute()
    {
        return
            ($this->kabel_jumlah ?? 0) +
            ($this->tiang_jumlah ?? 0) +
            ($this->trafo_jumlah ?? 0) +
            ($this->plta_jumlah ?? 0) +
            ($this->pltu_jumlah ?? 0) +
            ($this->pltd_jumlah ?? 0) +
            ($this->pembangkit_lain_jumlah ?? 0) +
            ($this->biaya_genset_total ?? 0);
    }

    protected static function boot()
    {
        parent::boot();
        static::saving(function ($model) {
            $model->kabel_jumlah = ($model->kabel_unit ?? 0) * ($model->kabel_harga_satuan ?? 0);
            $model->tiang_jumlah = ($model->tiang_unit ?? 0) * ($model->tiang_harga_satuan ?? 0);
            $model->trafo_jumlah = ($model->trafo_unit ?? 0) * ($model->trafo_harga_satuan ?? 0);
            $model->plta_jumlah = ($model->plta_unit ?? 0) * ($model->plta_harga_satuan ?? 0);
            $model->pltu_jumlah = ($model->pltu_unit ?? 0) * ($model->pltu_harga_satuan ?? 0);
            $model->pltd_jumlah = ($model->pltd_unit ?? 0) * ($model->pltd_harga_satuan ?? 0);
            $model->pembangkit_lain_jumlah = ($model->pembangkit_lain_unit ?? 0) * ($model->pembangkit_lain_harga_satuan ?? 0);
            $model->biaya_genset_total = ($model->genset_unit ?? 0) * ($model->genset_biaya_pengadaan ?? 0);
        });
    }
}
