<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Format4Form4 extends Model
{
    use HasFactory;

    protected $table = 'format4_form4s';

    protected $fillable = [
        'bencana_id',
        'nama_kampung',
        'nama_distrik',
        // Panti Asuhan
        'panti_sosial_rb_negeri', 'panti_sosial_rb_swasta', 'panti_sosial_rs_negeri', 'panti_sosial_rs_swasta', 'panti_sosial_rr_negeri', 'panti_sosial_rr_swasta', 'panti_sosial_luas', 'panti_sosial_harga_bangunan', 'panti_sosial_harga_peralatan', 'panti_sosial_harga_meubelair', 'panti_sosial_harga_peralatan_lab',
        // Panti Wredha
        'panti_asuhan_rb_negeri', 'panti_asuhan_rb_swasta', 'panti_asuhan_rs_negeri', 'panti_asuhan_rs_swasta', 'panti_asuhan_rr_negeri', 'panti_asuhan_rr_swasta', 'panti_asuhan_luas', 'panti_asuhan_harga_bangunan', 'panti_asuhan_harga_peralatan', 'panti_asuhan_harga_meubelair', 'panti_asuhan_harga_peralatan_lab',
        // Balai Pelayanan
        'balai_pelayanan_rb_negeri', 'balai_pelayanan_rb_swasta', 'balai_pelayanan_rs_negeri', 'balai_pelayanan_rs_swasta', 'balai_pelayanan_rr_negeri', 'balai_pelayanan_rr_swasta', 'balai_pelayanan_luas', 'balai_pelayanan_harga_bangunan', 'balai_pelayanan_harga_peralatan', 'balai_pelayanan_harga_meubelair', 'balai_pelayanan_harga_peralatan_lab',
        // Lainnya
        'lainnya_jenis', 'lainnya_rb_negeri', 'lainnya_rb_swasta', 'lainnya_rs_negeri', 'lainnya_rs_swasta', 'lainnya_rr_negeri', 'lainnya_rr_swasta', 'lainnya_luas', 'lainnya_harga_bangunan', 'lainnya_harga_peralatan', 'lainnya_harga_meubelair', 'lainnya_harga_peralatan_lab',
        // Kerugian
        'biaya_tenaga_kerja_hok', 'biaya_tenaga_kerja_upah', 'biaya_alat_berat_hari', 'biaya_alat_berat_harga', 'jumlah_penerima', 'bantuan_per_orang', 'biaya_pelayanan_kesehatan', 'biaya_pelayanan_pendidikan', 'biaya_pendampingan_psikososial', 'biaya_pelatihan_darurat',
        // Total
        'total_kerusakan', 'total_kerugian',
    ];

    protected $casts = [
        'panti_sosial_rb_negeri' => 'integer', 'panti_sosial_rb_swasta' => 'integer', 'panti_sosial_rs_negeri' => 'integer', 'panti_sosial_rs_swasta' => 'integer', 'panti_sosial_rr_negeri' => 'integer', 'panti_sosial_rr_swasta' => 'integer', 'panti_sosial_harga_bangunan' => 'decimal:2',
        'panti_asuhan_rb_negeri' => 'integer', 'panti_asuhan_rb_swasta' => 'integer', 'panti_asuhan_rs_negeri' => 'integer', 'panti_asuhan_rs_swasta' => 'integer', 'panti_asuhan_rr_negeri' => 'integer', 'panti_asuhan_rr_swasta' => 'integer', 'panti_asuhan_harga_bangunan' => 'decimal:2',
        'balai_pelayanan_rb_negeri' => 'integer', 'balai_pelayanan_rb_swasta' => 'integer', 'balai_pelayanan_rs_negeri' => 'integer', 'balai_pelayanan_rs_swasta' => 'integer', 'balai_pelayanan_rr_negeri' => 'integer', 'balai_pelayanan_rr_swasta' => 'integer', 'balai_pelayanan_harga_bangunan' => 'decimal:2',
        'lainnya_rb_negeri' => 'integer', 'lainnya_rb_swasta' => 'integer', 'lainnya_rs_negeri' => 'integer', 'lainnya_rs_swasta' => 'integer', 'lainnya_rr_negeri' => 'integer', 'lainnya_rr_swasta' => 'integer', 'lainnya_harga_bangunan' => 'decimal:2',
        'biaya_tenaga_kerja_hok' => 'integer', 'biaya_tenaga_kerja_upah' => 'decimal:2', 'biaya_alat_berat_hari' => 'integer', 'biaya_alat_berat_harga' => 'decimal:2', 'jumlah_penerima' => 'integer', 'bantuan_per_orang' => 'decimal:2', 'biaya_pelayanan_kesehatan' => 'decimal:2', 'biaya_pelayanan_pendidikan' => 'decimal:2', 'biaya_pendampingan_psikososial' => 'decimal:2', 'biaya_pelatihan_darurat' => 'decimal:2',
        'total_kerusakan' => 'decimal:2', 'total_kerugian' => 'decimal:2',
    ];

    // Relationship to Bencana
    public function bencana()
    {
        return $this->belongsTo(Bencana::class);
    }

    // Relationship to Rekap
    public function rekap()
    {
        return $this->hasOne(Rekap::class, 'format4_form4_id');
    }

    // Calculate total kerusakan (damage) - now includes all kerugian items moved from losses
    public function calculateTotalKerusakan()
    {
        $faskes = ['panti_sosial', 'panti_asuhan', 'balai_pelayanan', 'lainnya'];
        $totalKerusakan = 0;
        
        // 1. Kerusakan bangunan fasilitas perlindungan sosial (tanpa luas)
        foreach ($faskes as $f) {
            // Rusak berat (100% x harga bangunan)
            $totalKerusakan += (($this->{$f.'_rb_negeri'} ?? 0) + ($this->{$f.'_rb_swasta'} ?? 0)) * ($this->{$f.'_harga_bangunan'} ?? 0);
            // Rusak sedang (75% x harga bangunan)
            $totalKerusakan += (($this->{$f.'_rs_negeri'} ?? 0) + ($this->{$f.'_rs_swasta'} ?? 0)) * ($this->{$f.'_harga_bangunan'} ?? 0) * 0.75;
            // Rusak ringan (50% x harga bangunan)
            $totalKerusakan += (($this->{$f.'_rr_negeri'} ?? 0) + ($this->{$f.'_rr_swasta'} ?? 0)) * ($this->{$f.'_harga_bangunan'} ?? 0) * 0.5;
        }
        
        // 2. Biaya pembersihan puing (dipindahkan dari kerugian ke kerusakan)
        $totalKerusakan += ($this->biaya_tenaga_kerja_hok ?? 0) * ($this->biaya_tenaga_kerja_upah ?? 0);
        $totalKerusakan += ($this->biaya_alat_berat_hari ?? 0) * ($this->biaya_alat_berat_harga ?? 0);
        
        // 3. Biaya penyediaan jatah hidup (dipindahkan dari kerugian ke kerusakan)
        $totalKerusakan += ($this->jumlah_penerima ?? 0) * ($this->bantuan_per_orang ?? 0);
        
        // 4. Tambahan biaya sosial (dipindahkan dari kerugian ke kerusakan)
        $totalKerusakan += ($this->biaya_pelayanan_kesehatan ?? 0);
        $totalKerusakan += ($this->biaya_pelayanan_pendidikan ?? 0);
        $totalKerusakan += ($this->biaya_pendampingan_psikososial ?? 0);
        $totalKerusakan += ($this->biaya_pelatihan_darurat ?? 0);

        return $totalKerusakan;
    }

    // Calculate total kerugian (losses) - now returns 0 since all moved to kerusakan
    public function calculateTotalKerugian()
    {
        // All kerugian items have been moved to kerusakan calculation
        return 0;
    }
}
