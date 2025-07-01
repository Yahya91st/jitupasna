<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Format8Form4 extends Model
{
    use SoftDeletes;

    protected $table = 'format8_form4s';

    protected $fillable = [
        'bencana_id',
        'nama_kampung',
        'nama_distrik',
        
        // Sistem Transmisi dan Distribusi
        'kabel_rusak_berat',
        'kabel_rusak_sedang',
        'kabel_rusak_ringan',
        'kabel_harga_satuan',
        'tiang_rusak_berat',
        'tiang_rusak_sedang', 
        'tiang_rusak_ringan',
        'tiang_harga_satuan',
        'trafo_rusak_berat',
        'trafo_rusak_sedang',
        'trafo_rusak_ringan',
        'trafo_harga_satuan',
        
        // Sistem Pembangkitan
        'plta_rusak_berat',
        'plta_rusak_sedang',
        'plta_rusak_ringan',
        'plta_harga_satuan',
        'pltu_rusak_berat',
        'pltu_rusak_sedang',
        'pltu_rusak_ringan',
        'pltu_harga_satuan',
        'pltd_rusak_berat',
        'pltd_rusak_sedang',
        'pltd_rusak_ringan',
        'pltd_harga_satuan',
        'pembangkit_lain_rusak_berat',
        'pembangkit_lain_rusak_sedang',
        'pembangkit_lain_rusak_ringan',
        'pembangkit_lain_harga_satuan',
        'pembangkit_lain_keterangan',
        
        // Perkiraan Jangka Waktu Pemulihan
        'jangka_waktu_pemulihan_bulan',
        
        // Pembangkit Listrik Darurat
        'genset_unit',
        'genset_biaya_pengadaan',
        
        // Perkiraan Kehilangan/Penurunan Pendapatan
        'permintaan_listrik_sebelum_kwh',
        'permintaan_listrik_pasca_kwh',
        'tarif_listrik_per_kwh',
        'penurunan_pendapatan',
        
        // Perkiraan Kenaikan Biaya Operasional
        'biaya_operasional_sebelum',
        'biaya_operasional_pasca',
        'kenaikan_biaya_operasional',
    ];

    protected $casts = [
        'bencana_id' => 'integer',
        
        // Sistem Transmisi dan Distribusi
        'kabel_rusak_berat' => 'decimal:2',
        'kabel_rusak_sedang' => 'decimal:2',
        'kabel_rusak_ringan' => 'decimal:2',
        'kabel_harga_satuan' => 'decimal:2',
        'tiang_rusak_berat' => 'integer',
        'tiang_rusak_sedang' => 'integer',
        'tiang_rusak_ringan' => 'integer',
        'tiang_harga_satuan' => 'decimal:2',
        'trafo_rusak_berat' => 'integer',
        'trafo_rusak_sedang' => 'integer',
        'trafo_rusak_ringan' => 'integer',
        'trafo_harga_satuan' => 'decimal:2',
        
        // Sistem Pembangkitan
        'plta_rusak_berat' => 'integer',
        'plta_rusak_sedang' => 'integer',
        'plta_rusak_ringan' => 'integer',
        'plta_harga_satuan' => 'decimal:2',
        'pltu_rusak_berat' => 'integer',
        'pltu_rusak_sedang' => 'integer',
        'pltu_rusak_ringan' => 'integer',
        'pltu_harga_satuan' => 'decimal:2',
        'pltd_rusak_berat' => 'integer',
        'pltd_rusak_sedang' => 'integer',
        'pltd_rusak_ringan' => 'integer',
        'pltd_harga_satuan' => 'decimal:2',
        'pembangkit_lain_rusak_berat' => 'integer',
        'pembangkit_lain_rusak_sedang' => 'integer',
        'pembangkit_lain_rusak_ringan' => 'integer',
        'pembangkit_lain_harga_satuan' => 'decimal:2',
        
        // Waktu pemulihan
        'jangka_waktu_pemulihan_bulan' => 'integer',
        
        // Genset
        'genset_unit' => 'integer',
        'genset_biaya_pengadaan' => 'decimal:2',
        
        // Pendapatan
        'permintaan_listrik_sebelum_kwh' => 'decimal:2',
        'permintaan_listrik_pasca_kwh' => 'decimal:2',
        'tarif_listrik_per_kwh' => 'decimal:2',
        'penurunan_pendapatan' => 'decimal:2',
        
        // Biaya operasional
        'biaya_operasional_sebelum' => 'decimal:2',
        'biaya_operasional_pasca' => 'decimal:2',
        'kenaikan_biaya_operasional' => 'decimal:2',
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
     * Calculate total kerusakan sistem transmisi dan distribusi
     */
    public function getTotalKerusakanTransmisiDistribusiAttribute()
    {
        $total_kabel = (($this->kabel_rusak_berat ?? 0) + ($this->kabel_rusak_sedang ?? 0) + ($this->kabel_rusak_ringan ?? 0)) * ($this->kabel_harga_satuan ?? 0);
        $total_tiang = (($this->tiang_rusak_berat ?? 0) + ($this->tiang_rusak_sedang ?? 0) + ($this->tiang_rusak_ringan ?? 0)) * ($this->tiang_harga_satuan ?? 0);
        $total_trafo = (($this->trafo_rusak_berat ?? 0) + ($this->trafo_rusak_sedang ?? 0) + ($this->trafo_rusak_ringan ?? 0)) * ($this->trafo_harga_satuan ?? 0);
        
        return $total_kabel + $total_tiang + $total_trafo;
    }

    /**
     * Calculate total kerusakan sistem pembangkitan
     */
    public function getTotalKerusakanPembangkitanAttribute()
    {
        $total_plta = (($this->plta_rusak_berat ?? 0) + ($this->plta_rusak_sedang ?? 0) + ($this->plta_rusak_ringan ?? 0)) * ($this->plta_harga_satuan ?? 0);
        $total_pltu = (($this->pltu_rusak_berat ?? 0) + ($this->pltu_rusak_sedang ?? 0) + ($this->pltu_rusak_ringan ?? 0)) * ($this->pltu_harga_satuan ?? 0);
        $total_pltd = (($this->pltd_rusak_berat ?? 0) + ($this->pltd_rusak_sedang ?? 0) + ($this->pltd_rusak_ringan ?? 0)) * ($this->pltd_harga_satuan ?? 0);
        $total_lain = (($this->pembangkit_lain_rusak_berat ?? 0) + ($this->pembangkit_lain_rusak_sedang ?? 0) + ($this->pembangkit_lain_rusak_ringan ?? 0)) * ($this->pembangkit_lain_harga_satuan ?? 0);
        
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
}
