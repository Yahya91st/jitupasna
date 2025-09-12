<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Format5Form4 extends Model
{
    protected $table = 'format5_form4s';

    protected $fillable = [
        'bencana_id',
        'nama_kampung',
        'nama_distrik',
        // Gereja
        'gereja_rb_negeri', 'gereja_rb_swasta', 'gereja_rs_negeri', 'gereja_rs_swasta', 'gereja_rr_negeri', 'gereja_rr_swasta', 'gereja_luas', 'gereja_harga_bangunan', 'gereja_harga_peralatan',
        // Kapel
        'kapel_rb_negeri', 'kapel_rb_swasta', 'kapel_rs_negeri', 'kapel_rs_swasta', 'kapel_rr_negeri', 'kapel_rr_swasta', 'kapel_luas', 'kapel_harga_bangunan', 'kapel_harga_peralatan',
        // Masjid
        'masjid_rb_negeri', 'masjid_rb_swasta', 'masjid_rs_negeri', 'masjid_rs_swasta', 'masjid_rr_negeri', 'masjid_rr_swasta', 'masjid_luas', 'masjid_harga_bangunan', 'masjid_harga_peralatan',
        // Musholla
        'musholla_rb_negeri', 'musholla_rb_swasta', 'musholla_rs_negeri', 'musholla_rs_swasta', 'musholla_rr_negeri', 'musholla_rr_swasta', 'musholla_luas', 'musholla_harga_bangunan', 'musholla_harga_peralatan',
        // Pura
        'pura_rb_negeri', 'pura_rb_swasta', 'pura_rs_negeri', 'pura_rs_swasta', 'pura_rr_negeri', 'pura_rr_swasta', 'pura_luas', 'pura_harga_bangunan', 'pura_harga_peralatan',
        // Vihara
        'vihara_rb_negeri', 'vihara_rb_swasta', 'vihara_rs_negeri', 'vihara_rs_swasta', 'vihara_rr_negeri', 'vihara_rr_swasta', 'vihara_luas', 'vihara_harga_bangunan', 'vihara_harga_peralatan',
        // Kerugian
        'biaya_tenaga_kerja_hok', 'biaya_tenaga_kerja_upah', 'biaya_alat_berat_hari', 'biaya_alat_berat_harga',
        // Total (jika ada)
        'total_kerusakan', 'total_kerugian',
    ];

    protected $casts = [
        'gereja_rb_negeri' => 'integer', 'gereja_rb_swasta' => 'integer', 'gereja_rs_negeri' => 'integer', 'gereja_rs_swasta' => 'integer', 'gereja_rr_negeri' => 'integer', 'gereja_rr_swasta' => 'integer', 'gereja_luas' => 'decimal:2', 'gereja_harga_bangunan' => 'decimal:2', 'gereja_harga_peralatan' => 'decimal:2',
        'kapel_rb_negeri' => 'integer', 'kapel_rb_swasta' => 'integer', 'kapel_rs_negeri' => 'integer', 'kapel_rs_swasta' => 'integer', 'kapel_rr_negeri' => 'integer', 'kapel_rr_swasta' => 'integer', 'kapel_luas' => 'decimal:2', 'kapel_harga_bangunan' => 'decimal:2', 'kapel_harga_peralatan' => 'decimal:2',
        'masjid_rb_negeri' => 'integer', 'masjid_rb_swasta' => 'integer', 'masjid_rs_negeri' => 'integer', 'masjid_rs_swasta' => 'integer', 'masjid_rr_negeri' => 'integer', 'masjid_rr_swasta' => 'integer', 'masjid_luas' => 'decimal:2', 'masjid_harga_bangunan' => 'decimal:2', 'masjid_harga_peralatan' => 'decimal:2',
        'musholla_rb_negeri' => 'integer', 'musholla_rb_swasta' => 'integer', 'musholla_rs_negeri' => 'integer', 'musholla_rs_swasta' => 'integer', 'musholla_rr_negeri' => 'integer', 'musholla_rr_swasta' => 'integer', 'musholla_luas' => 'decimal:2', 'musholla_harga_bangunan' => 'decimal:2', 'musholla_harga_peralatan' => 'decimal:2',
        'pura_rb_negeri' => 'integer', 'pura_rb_swasta' => 'integer', 'pura_rs_negeri' => 'integer', 'pura_rs_swasta' => 'integer', 'pura_rr_negeri' => 'integer', 'pura_rr_swasta' => 'integer', 'pura_luas' => 'decimal:2', 'pura_harga_bangunan' => 'decimal:2', 'pura_harga_peralatan' => 'decimal:2',
        'vihara_rb_negeri' => 'integer', 'vihara_rb_swasta' => 'integer', 'vihara_rs_negeri' => 'integer', 'vihara_rs_swasta' => 'integer', 'vihara_rr_negeri' => 'integer', 'vihara_rr_swasta' => 'integer', 'vihara_luas' => 'decimal:2', 'vihara_harga_bangunan' => 'decimal:2', 'vihara_harga_peralatan' => 'decimal:2',
        'biaya_tenaga_kerja_hok' => 'decimal:2', 'biaya_tenaga_kerja_upah' => 'decimal:2', 'biaya_alat_berat_hari' => 'integer', 'biaya_alat_berat_harga' => 'decimal:2',
        'total_kerusakan' => 'decimal:2', 'total_kerugian' => 'decimal:2',
    ];

    /**
     * Get the bencana that owns the Format5Form4.
     */
    public function bencana(): BelongsTo
    {
        return $this->belongsTo(Bencana::class);
    }
    
    /**
     * Calculate total kerusakan for Format 5 (Religious sector)
     * Total kerusakan = semua item kerusakan + semua item kerugian (kerugian = 0)
     * TIDAK menggunakan "Rata-Rata Luas Bangunan" sesuai permintaan
     */
    public function calculateTotalKerusakan()
    {
        $totalKerusakan = 0;
        
        // Daftar jenis bangunan ibadah
        $jenisIbadah = ['gereja', 'kapel', 'masjid', 'musholla', 'pura', 'vihara'];
        
        foreach ($jenisIbadah as $jenis) {
            // Hitung total unit kerusakan
            $totalUnit = ($this->{$jenis . '_rb_negeri'} ?? 0) + 
                        ($this->{$jenis . '_rb_swasta'} ?? 0) + 
                        ($this->{$jenis . '_rs_negeri'} ?? 0) + 
                        ($this->{$jenis . '_rs_swasta'} ?? 0) + 
                        ($this->{$jenis . '_rr_negeri'} ?? 0) + 
                        ($this->{$jenis . '_rr_swasta'} ?? 0);
            
            // TIDAK menggunakan luas dan peralatan dalam perhitungan sesuai permintaan
            // $luas = $this->{$jenis . '_luas'} ?? 0;
            $hargaBangunan = $this->{$jenis . '_harga_bangunan'} ?? 0;
            // $hargaPeralatan = $this->{$jenis . '_harga_peralatan'} ?? 0; // TIDAK DIGUNAKAN
            
            // Kerusakan = HANYA (total unit * harga bangunan) 
            // TANPA mengalikan dengan luas dan TANPA harga peralatan
            $totalKerusakan += ($totalUnit * $hargaBangunan);
        }
        
        // Tambahkan kerugian (biaya pembersihan puing) ke total kerusakan
        $biayaTenagaKerja = ($this->biaya_tenaga_kerja_hok ?? 0) * ($this->biaya_tenaga_kerja_upah ?? 0);
        $biayaAlatBerat = ($this->biaya_alat_berat_hari ?? 0) * ($this->biaya_alat_berat_harga ?? 0);
        
        $totalKerusakan += $biayaTenagaKerja + $biayaAlatBerat;
        
        return $totalKerusakan;
    }
    
    /**
     * Calculate total kerugian (sesuai permintaan: kerugian = 0)
     */
    public function calculateTotalKerugian()
    {
        // Sesuai permintaan: kerugian = 0, semua masuk ke total kerusakan
        return 0;
    }
    
    /**
     * Automatically calculate totals when saving
     */
    protected static function boot()
    {
        parent::boot();
        
        static::saving(function ($model) {
            $model->total_kerusakan = $model->calculateTotalKerusakan();
            $model->total_kerugian = $model->calculateTotalKerugian();
        });
    }
}
