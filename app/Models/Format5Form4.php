<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Format5Form4 extends Model
{
    use SoftDeletes;

    protected $table = 'format5_form4s';

    protected $fillable = [
        'bencana_id',
        'nama_kampung',
        'nama_distrik',
        
        // Gereja
        'gereja_rb_negeri',
        'gereja_rb_swasta', 
        'gereja_rs_negeri',
        'gereja_rs_swasta',
        'gereja_rr_negeri',
        'gereja_rr_swasta',
        'gereja_luas',
        'gereja_harga_bangunan',
        'gereja_harga_peralatan',
        
        // Kapel
        'kapel_rb_negeri',
        'kapel_rb_swasta',
        'kapel_rs_negeri', 
        'kapel_rs_swasta',
        'kapel_rr_negeri',
        'kapel_rr_swasta',
        'kapel_luas',
        'kapel_harga_bangunan',
        'kapel_harga_peralatan',
        
        // Masjid
        'masjid_rb_negeri',
        'masjid_rb_swasta',
        'masjid_rs_negeri',
        'masjid_rs_swasta', 
        'masjid_rr_negeri',
        'masjid_rr_swasta',
        'masjid_luas',
        'masjid_harga_bangunan',
        'masjid_harga_peralatan',
        
        // Musholla
        'musholla_rb_negeri',
        'musholla_rb_swasta',
        'musholla_rs_negeri',
        'musholla_rs_swasta',
        'musholla_rr_negeri', 
        'musholla_rr_swasta',
        'musholla_luas',
        'musholla_harga_bangunan',
        'musholla_harga_peralatan',
        
        // Pura
        'pura_rb_negeri',
        'pura_rb_swasta',
        'pura_rs_negeri',
        'pura_rs_swasta',
        'pura_rr_negeri',
        'pura_rr_swasta',
        'pura_luas',
        'pura_harga_bangunan', 
        'pura_harga_peralatan',
        
        // Vihara
        'vihara_rb_negeri',
        'vihara_rb_swasta',
        'vihara_rs_negeri',
        'vihara_rs_swasta',
        'vihara_rr_negeri',
        'vihara_rr_swasta',
        'vihara_luas',
        'vihara_harga_bangunan',
        'vihara_harga_peralatan',
        
        // Biaya pembersihan puing
        'biaya_tenaga_kerja_hok',
        'biaya_tenaga_kerja_upah',
        'biaya_alat_berat_hari',
        'biaya_alat_berat_harga',
    ];

    protected $casts = [
        'bencana_id' => 'integer',
        
        // Gereja
        'gereja_rb_negeri' => 'integer',
        'gereja_rb_swasta' => 'integer',
        'gereja_rs_negeri' => 'integer', 
        'gereja_rs_swasta' => 'integer',
        'gereja_rr_negeri' => 'integer',
        'gereja_rr_swasta' => 'integer',
        'gereja_luas' => 'decimal:2',
        'gereja_harga_bangunan' => 'decimal:2',
        'gereja_harga_peralatan' => 'decimal:2',
        
        // Kapel
        'kapel_rb_negeri' => 'integer',
        'kapel_rb_swasta' => 'integer',
        'kapel_rs_negeri' => 'integer',
        'kapel_rs_swasta' => 'integer',
        'kapel_rr_negeri' => 'integer',
        'kapel_rr_swasta' => 'integer',
        'kapel_luas' => 'decimal:2',
        'kapel_harga_bangunan' => 'decimal:2',
        'kapel_harga_peralatan' => 'decimal:2',
        
        // Masjid
        'masjid_rb_negeri' => 'integer',
        'masjid_rb_swasta' => 'integer',
        'masjid_rs_negeri' => 'integer',
        'masjid_rs_swasta' => 'integer',
        'masjid_rr_negeri' => 'integer',
        'masjid_rr_swasta' => 'integer', 
        'masjid_luas' => 'decimal:2',
        'masjid_harga_bangunan' => 'decimal:2',
        'masjid_harga_peralatan' => 'decimal:2',
        
        // Musholla
        'musholla_rb_negeri' => 'integer',
        'musholla_rb_swasta' => 'integer',
        'musholla_rs_negeri' => 'integer',
        'musholla_rs_swasta' => 'integer',
        'musholla_rr_negeri' => 'integer',
        'musholla_rr_swasta' => 'integer',
        'musholla_luas' => 'decimal:2',
        'musholla_harga_bangunan' => 'decimal:2',
        'musholla_harga_peralatan' => 'decimal:2',
        
        // Pura
        'pura_rb_negeri' => 'integer',
        'pura_rb_swasta' => 'integer', 
        'pura_rs_negeri' => 'integer',
        'pura_rs_swasta' => 'integer',
        'pura_rr_negeri' => 'integer',
        'pura_rr_swasta' => 'integer',
        'pura_luas' => 'decimal:2',
        'pura_harga_bangunan' => 'decimal:2',
        'pura_harga_peralatan' => 'decimal:2',
        
        // Vihara
        'vihara_rb_negeri' => 'integer',
        'vihara_rb_swasta' => 'integer',
        'vihara_rs_negeri' => 'integer',
        'vihara_rs_swasta' => 'integer',
        'vihara_rr_negeri' => 'integer',
        'vihara_rr_swasta' => 'integer',
        'vihara_luas' => 'decimal:2',
        'vihara_harga_bangunan' => 'decimal:2',
        'vihara_harga_peralatan' => 'decimal:2',
        
        // Biaya pembersihan puing
        'biaya_tenaga_kerja_hok' => 'decimal:2',
        'biaya_tenaga_kerja_upah' => 'decimal:2',
        'biaya_alat_berat_hari' => 'decimal:2',
        'biaya_alat_berat_harga' => 'decimal:2',
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
     * Calculate total kerusakan bangunan ibadah
     */
    public function getTotalKerusakanBangunanAttribute()
    {
        $types = ['gereja', 'kapel', 'masjid', 'musholla', 'pura', 'vihara'];
        $total = 0;

        foreach ($types as $type) {
            $rb_negeri = $this->{$type . '_rb_negeri'} ?? 0;
            $rb_swasta = $this->{$type . '_rb_swasta'} ?? 0;
            $rs_negeri = $this->{$type . '_rs_negeri'} ?? 0;
            $rs_swasta = $this->{$type . '_rs_swasta'} ?? 0;
            $rr_negeri = $this->{$type . '_rr_negeri'} ?? 0;
            $rr_swasta = $this->{$type . '_rr_swasta'} ?? 0;
            $luas = $this->{$type . '_luas'} ?? 0;
            $harga_bangunan = $this->{$type . '_harga_bangunan'} ?? 0;

            // Perhitungan: (jumlah unit rusak x luas x harga bangunan)
            $total_unit_rusak = $rb_negeri + $rb_swasta + $rs_negeri + $rs_swasta + $rr_negeri + $rr_swasta;
            $total += $total_unit_rusak * $luas * $harga_bangunan;
        }

        return $total;
    }

    /**
     * Calculate total kerugian peralatan keagamaan
     */
    public function getTotalKerugianPeralatanAttribute()
    {
        $types = ['gereja', 'kapel', 'masjid', 'musholla', 'pura', 'vihara'];
        $total = 0;

        foreach ($types as $type) {
            $rb_negeri = $this->{$type . '_rb_negeri'} ?? 0;
            $rb_swasta = $this->{$type . '_rb_swasta'} ?? 0;
            $rs_negeri = $this->{$type . '_rs_negeri'} ?? 0;
            $rs_swasta = $this->{$type . '_rs_swasta'} ?? 0;
            $rr_negeri = $this->{$type . '_rr_negeri'} ?? 0;
            $rr_swasta = $this->{$type . '_rr_swasta'} ?? 0;
            $harga_peralatan = $this->{$type . '_harga_peralatan'} ?? 0;

            // Perhitungan: jumlah unit rusak x harga peralatan
            $total_unit_rusak = $rb_negeri + $rb_swasta + $rs_negeri + $rs_swasta + $rr_negeri + $rr_swasta;
            $total += $total_unit_rusak * $harga_peralatan;
        }

        return $total;
    }

    /**
     * Calculate total biaya pembersihan puing
     */
    public function getTotalBiayaPembersihanAttribute()
    {
        $biaya_tenaga_kerja = ($this->biaya_tenaga_kerja_hok ?? 0) * ($this->biaya_tenaga_kerja_upah ?? 0);
        $biaya_alat_berat = ($this->biaya_alat_berat_hari ?? 0) * ($this->biaya_alat_berat_harga ?? 0);
        
        return $biaya_tenaga_kerja + $biaya_alat_berat;
    }

    /**
     * Calculate grand total kerusakan + kerugian
     */
    public function getGrandTotalAttribute()
    {
        return $this->total_kerusakan_bangunan + $this->total_kerugian_peralatan + $this->total_biaya_pembersihan;
    }
}
