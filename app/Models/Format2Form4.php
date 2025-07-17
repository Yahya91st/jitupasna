<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Format2Form4 extends Model
{
    use HasFactory;

    protected $table = 'format2_form4s';

    protected $fillable = [
        'bencana_id',
        'nama_kampung',
        'nama_distrik',
        // TK/RA
        'tk_berat_negeri', 'tk_berat_swasta', 'tk_sedang_negeri', 'tk_sedang_swasta', 'tk_ringan_negeri', 'tk_ringan_swasta', 'tk_ukuran', 'tk_harga_bangunan', 'tk_harga_peralatan', 'tk_harga_meubelair',
        // SD/MI
        'sd_berat_negeri', 'sd_berat_swasta', 'sd_sedang_negeri', 'sd_sedang_swasta', 'sd_ringan_negeri', 'sd_ringan_swasta', 'sd_ukuran', 'sd_harga_bangunan', 'sd_harga_peralatan', 'sd_harga_meubelair',
        // SMP/MTS
        'smp_berat_negeri', 'smp_berat_swasta', 'smp_sedang_negeri', 'smp_sedang_swasta', 'smp_ringan_negeri', 'smp_ringan_swasta', 'smp_ukuran', 'smp_harga_bangunan', 'smp_harga_peralatan', 'smp_harga_meubelair',
        // SMA/MA
        'sma_berat_negeri', 'sma_berat_swasta', 'sma_sedang_negeri', 'sma_sedang_swasta', 'sma_ringan_negeri', 'sma_ringan_swasta', 'sma_ukuran', 'sma_harga_bangunan', 'sma_harga_peralatan', 'sma_harga_meubelair',
        // SMK
        'smk_berat_negeri', 'smk_berat_swasta', 'smk_sedang_negeri', 'smk_sedang_swasta', 'smk_ringan_negeri', 'smk_ringan_swasta', 'smk_ukuran', 'smk_harga_bangunan', 'smk_harga_peralatan', 'smk_harga_meubelair',
        // Perguruan Tinggi
        'pt_berat_negeri', 'pt_berat_swasta', 'pt_sedang_negeri', 'pt_sedang_swasta', 'pt_ringan_negeri', 'pt_ringan_swasta', 'pt_ukuran', 'pt_harga_bangunan', 'pt_harga_peralatan', 'pt_harga_meubelair',
        // Perpustakaan
        'perpus_berat_negeri', 'perpus_berat_swasta', 'perpus_sedang_negeri', 'perpus_sedang_swasta', 'perpus_ringan_negeri', 'perpus_ringan_swasta', 'perpus_ukuran', 'perpus_harga_bangunan', 'perpus_harga_peralatan', 'perpus_harga_meubelair',
        // Laboratorium
        'lab_berat_negeri', 'lab_berat_swasta', 'lab_sedang_negeri', 'lab_sedang_swasta', 'lab_ringan_negeri', 'lab_ringan_swasta', 'lab_ukuran', 'lab_harga_bangunan', 'lab_harga_peralatan', 'lab_harga_meubelair',
        // Lainnya
        'lainnya_berat_negeri', 'lainnya_berat_swasta', 'lainnya_sedang_negeri', 'lainnya_sedang_swasta', 'lainnya_ringan_negeri', 'lainnya_ringan_swasta', 'lainnya_ukuran', 'lainnya_harga_bangunan', 'lainnya_harga_peralatan', 'lainnya_harga_meubelair',
        // Kerugian & info sekolah
        'biaya_tenaga_kerja_hok', 'biaya_tenaga_kerja_upah', 'biaya_alat_berat_hari', 'biaya_alat_berat_harga',
        'sekolah_pengungsian', 'guru_korban', 'iuran_sekolah',
        'jumlah_sekolah_sementara', 'harga_sekolah_sementara',
        // Rekap
        'total_kerusakan', 'total_kerugian',
    ];

    protected $casts = [
        // Integer fields
        'tk_berat_negeri' => 'integer', 'tk_berat_swasta' => 'integer', 'tk_sedang_negeri' => 'integer', 'tk_sedang_swasta' => 'integer', 'tk_ringan_negeri' => 'integer', 'tk_ringan_swasta' => 'integer', 'tk_ukuran' => 'integer', 'tk_harga_bangunan' => 'decimal:2',
        'sd_berat_negeri' => 'integer', 'sd_berat_swasta' => 'integer', 'sd_sedang_negeri' => 'integer', 'sd_sedang_swasta' => 'integer', 'sd_ringan_negeri' => 'integer', 'sd_ringan_swasta' => 'integer', 'sd_ukuran' => 'integer', 'sd_harga_bangunan' => 'decimal:2',
        'smp_berat_negeri' => 'integer', 'smp_berat_swasta' => 'integer', 'smp_sedang_negeri' => 'integer', 'smp_sedang_swasta' => 'integer', 'smp_ringan_negeri' => 'integer', 'smp_ringan_swasta' => 'integer', 'smp_ukuran' => 'integer', 'smp_harga_bangunan' => 'decimal:2',
        'sma_berat_negeri' => 'integer', 'sma_berat_swasta' => 'integer', 'sma_sedang_negeri' => 'integer', 'sma_sedang_swasta' => 'integer', 'sma_ringan_negeri' => 'integer', 'sma_ringan_swasta' => 'integer', 'sma_ukuran' => 'integer', 'sma_harga_bangunan' => 'decimal:2',
        'smk_berat_negeri' => 'integer', 'smk_berat_swasta' => 'integer', 'smk_sedang_negeri' => 'integer', 'smk_sedang_swasta' => 'integer', 'smk_ringan_negeri' => 'integer', 'smk_ringan_swasta' => 'integer', 'smk_ukuran' => 'integer', 'smk_harga_bangunan' => 'decimal:2',
        'pt_berat_negeri' => 'integer', 'pt_berat_swasta' => 'integer', 'pt_sedang_negeri' => 'integer', 'pt_sedang_swasta' => 'integer', 'pt_ringan_negeri' => 'integer', 'pt_ringan_swasta' => 'integer', 'pt_ukuran' => 'integer', 'pt_harga_bangunan' => 'decimal:2',
        'perpus_berat_negeri' => 'integer', 'perpus_berat_swasta' => 'integer', 'perpus_sedang_negeri' => 'integer', 'perpus_sedang_swasta' => 'integer', 'perpus_ringan_negeri' => 'integer', 'perpus_ringan_swasta' => 'integer', 'perpus_ukuran' => 'integer', 'perpus_harga_bangunan' => 'decimal:2',
        'lab_berat_negeri' => 'integer', 'lab_berat_swasta' => 'integer', 'lab_sedang_negeri' => 'integer', 'lab_sedang_swasta' => 'integer', 'lab_ringan_negeri' => 'integer', 'lab_ringan_swasta' => 'integer', 'lab_ukuran' => 'integer', 'lab_harga_bangunan' => 'decimal:2',
        'lainnya_berat_negeri' => 'integer', 'lainnya_berat_swasta' => 'integer', 'lainnya_sedang_negeri' => 'integer', 'lainnya_sedang_swasta' => 'integer', 'lainnya_ringan_negeri' => 'integer', 'lainnya_ringan_swasta' => 'integer', 'lainnya_ukuran' => 'integer', 'lainnya_harga_bangunan' => 'decimal:2',
        // Kerugian & info sekolah
        'biaya_tenaga_kerja_hok' => 'integer', 'biaya_tenaga_kerja_upah' => 'decimal:2', 'biaya_alat_berat_hari' => 'integer', 'biaya_alat_berat_harga' => 'decimal:2',
        'sekolah_pengungsian' => 'integer', 'guru_korban' => 'integer', 'iuran_sekolah' => 'decimal:2',
        'jumlah_sekolah_sementara' => 'integer', 'harga_sekolah_sementara' => 'decimal:2',
        // Totals
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
        return $this->hasOne(Rekap::class, 'format2_form4_id');
    }

    // Calculate total kerusakan (damage)
    public function calculateTotalKerusakan()
    {
        $rumah_kerusakan = (
            ($this->rumah_hancur_total_permanen * $this->harga_satuan_permanen) +
            ($this->rumah_hancur_total_non_permanen * $this->harga_satuan_non_permanen) +
            ($this->rumah_rusak_berat_permanen * $this->harga_satuan_permanen * 0.75) +
            ($this->rumah_rusak_berat_non_permanen * $this->harga_satuan_non_permanen * 0.75) +
            ($this->rumah_rusak_sedang_permanen * $this->harga_satuan_permanen * 0.5) +
            ($this->rumah_rusak_sedang_non_permanen * $this->harga_satuan_non_permanen * 0.5) +
            ($this->rumah_rusak_ringan_permanen * $this->harga_satuan_permanen * 0.25) +
            ($this->rumah_rusak_ringan_non_permanen * $this->harga_satuan_non_permanen * 0.25)
        );

        $infrastruktur_kerusakan = (
            (($this->jalan_rusak_berat * 1.0) + ($this->jalan_rusak_sedang * 0.75) + ($this->jalan_rusak_ringan * 0.5)) * $this->harga_satuan_jalan +
            (($this->saluran_rusak_berat * 1.0) + ($this->saluran_rusak_sedang * 0.75) + ($this->saluran_rusak_ringan * 0.5)) * $this->harga_satuan_saluran +
            (($this->balai_rusak_berat * 1.0) + ($this->balai_rusak_sedang * 0.75) + ($this->balai_rusak_ringan * 0.5)) * $this->harga_satuan_balai
        );

        return $rumah_kerusakan + $infrastruktur_kerusakan;
    }

    // Calculate total kerugian (losses)
    public function calculateTotalKerugian()
    {
        return (
            ($this->tenaga_kerja_hok * $this->upah_harian) +
            ($this->alat_berat_hari * $this->biaya_per_hari) +
            ($this->jumlah_rumah_disewa * $this->harga_sewa_per_bulan * $this->durasi_sewa_bulan) +
            ($this->jumlah_tenda * $this->harga_tenda) +
            ($this->jumlah_barak * $this->harga_barak) +
            ($this->jumlah_rumah_sementara * $this->harga_rumah_sementara)
        );
    }
}
