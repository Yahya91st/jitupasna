<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Format3Form4 extends Model
{
    use HasFactory;

    protected $table = 'format3_form4s';

    protected $fillable = [
        'bencana_id',
        'nama_kampung',
        'nama_distrik',
        // Rumah Sakit
        'rs_rb_negeri', 'rs_rb_swasta', 'rs_rs_negeri', 'rs_rs_swasta', 'rs_rr_negeri', 'rs_rr_swasta', 'rs_luas', 'rs_harga_bangunan', 'rs_harga_obat', 'rs_harga_meubelair', 'rs_harga_peralatan',
        // Puskesmas
        'puskesmas_rb_negeri', 'puskesmas_rb_swasta', 'puskesmas_rs_negeri', 'puskesmas_rs_swasta', 'puskesmas_rr_negeri', 'puskesmas_rr_swasta', 'puskesmas_luas', 'puskesmas_harga_bangunan', 'puskesmas_harga_obat', 'puskesmas_harga_meubelair', 'puskesmas_harga_peralatan',
        // Poliklinik
        'poliklinik_rb_negeri', 'poliklinik_rb_swasta', 'poliklinik_rs_negeri', 'poliklinik_rs_swasta', 'poliklinik_rr_negeri', 'poliklinik_rr_swasta', 'poliklinik_luas', 'poliklinik_harga_bangunan', 'poliklinik_harga_obat', 'poliklinik_harga_meubelair', 'poliklinik_harga_peralatan',
        // Puskesmas Pembantu
        'pustu_rb_negeri', 'pustu_rb_swasta', 'pustu_rs_negeri', 'pustu_rs_swasta', 'pustu_rr_negeri', 'pustu_rr_swasta', 'pustu_luas', 'pustu_harga_bangunan', 'pustu_harga_obat', 'pustu_harga_meubelair', 'pustu_harga_peralatan',
        // Polindes
        'polindes_rb_negeri', 'polindes_rb_swasta', 'polindes_rs_negeri', 'polindes_rs_swasta', 'polindes_rr_negeri', 'polindes_rr_swasta', 'polindes_luas', 'polindes_harga_bangunan', 'polindes_harga_obat', 'polindes_harga_meubelair', 'polindes_harga_peralatan',
        // Posyandu
        'posyandu_rb_negeri', 'posyandu_rb_swasta', 'posyandu_rs_negeri', 'posyandu_rs_swasta', 'posyandu_rr_negeri', 'posyandu_rr_swasta', 'posyandu_luas', 'posyandu_harga_bangunan', 'posyandu_harga_obat', 'posyandu_harga_meubelair', 'posyandu_harga_peralatan',
        // Kerugian
        'biaya_tenaga_kerja_hok', 'biaya_tenaga_kerja_upah', 'biaya_alat_berat_hari', 'biaya_alat_berat_harga', 'jumlah_jenazah', 'biaya_per_jenazah', 'jumlah_pasien', 'biaya_per_pasien',
        'jenis_operasional', 'jumlah_faskes', 'biaya_pengadaan_faskes', 'jumlah_korban_psikologis', 'biaya_penanganan_psikologis', 'biaya_pencegahan_penyakit', 'jumlah_tenaga_kesehatan', 'honorarium_tenaga_kesehatan', 'pendapatan_faskes_swasta',
        // Total
        'total_kerusakan', 'total_kerugian',
    ];

    protected $casts = [
        'rs_rb_negeri' => 'integer', 'rs_rb_swasta' => 'integer', 'rs_rs_negeri' => 'integer', 'rs_rs_swasta' => 'integer', 'rs_rr_negeri' => 'integer', 'rs_rr_swasta' => 'integer', 'rs_luas' => 'decimal:2', 'rs_harga_bangunan' => 'decimal:2', 'rs_harga_obat' => 'string', 'rs_harga_meubelair' => 'string', 'rs_harga_peralatan' => 'string',
        'puskesmas_rb_negeri' => 'integer', 'puskesmas_rb_swasta' => 'integer', 'puskesmas_rs_negeri' => 'integer', 'puskesmas_rs_swasta' => 'integer', 'puskesmas_rr_negeri' => 'integer', 'puskesmas_rr_swasta' => 'integer', 'puskesmas_luas' => 'decimal:2', 'puskesmas_harga_bangunan' => 'decimal:2', 'puskesmas_harga_obat' => 'string', 'puskesmas_harga_meubelair' => 'string', 'puskesmas_harga_peralatan' => 'string',
        'poliklinik_rb_negeri' => 'integer', 'poliklinik_rb_swasta' => 'integer', 'poliklinik_rs_negeri' => 'integer', 'poliklinik_rs_swasta' => 'integer', 'poliklinik_rr_negeri' => 'integer', 'poliklinik_rr_swasta' => 'integer', 'poliklinik_luas' => 'decimal:2', 'poliklinik_harga_bangunan' => 'decimal:2', 'poliklinik_harga_obat' => 'string', 'poliklinik_harga_meubelair' => 'string', 'poliklinik_harga_peralatan' => 'string',
        'pustu_rb_negeri' => 'integer', 'pustu_rb_swasta' => 'integer', 'pustu_rs_negeri' => 'integer', 'pustu_rs_swasta' => 'integer', 'pustu_rr_negeri' => 'integer', 'pustu_rr_swasta' => 'integer', 'pustu_luas' => 'decimal:2', 'pustu_harga_bangunan' => 'decimal:2', 'pustu_harga_obat' => 'string', 'pustu_harga_meubelair' => 'string', 'pustu_harga_peralatan' => 'string',
        'polindes_rb_negeri' => 'integer', 'polindes_rb_swasta' => 'integer', 'polindes_rs_negeri' => 'integer', 'polindes_rs_swasta' => 'integer', 'polindes_rr_negeri' => 'integer', 'polindes_rr_swasta' => 'integer', 'polindes_luas' => 'decimal:2', 'polindes_harga_bangunan' => 'decimal:2', 'polindes_harga_obat' => 'string', 'polindes_harga_meubelair' => 'string', 'polindes_harga_peralatan' => 'string',
        'posyandu_rb_negeri' => 'integer', 'posyandu_rb_swasta' => 'integer', 'posyandu_rs_negeri' => 'integer', 'posyandu_rs_swasta' => 'integer', 'posyandu_rr_negeri' => 'integer', 'posyandu_rr_swasta' => 'integer', 'posyandu_luas' => 'decimal:2', 'posyandu_harga_bangunan' => 'decimal:2', 'posyandu_harga_obat' => 'string', 'posyandu_harga_meubelair' => 'string', 'posyandu_harga_peralatan' => 'string',
        'biaya_tenaga_kerja_hok' => 'decimal:2', 'biaya_tenaga_kerja_upah' => 'decimal:2', 'biaya_alat_berat_hari' => 'integer', 'biaya_alat_berat_harga' => 'decimal:2', 'jumlah_jenazah' => 'integer', 'biaya_per_jenazah' => 'decimal:2', 'jumlah_pasien' => 'integer', 'biaya_per_pasien' => 'decimal:2',
        'jumlah_faskes' => 'integer', 'biaya_pengadaan_faskes' => 'decimal:2', 'jumlah_korban_psikologis' => 'integer', 'biaya_penanganan_psikologis' => 'decimal:2', 'biaya_pencegahan_penyakit' => 'decimal:2', 'jumlah_tenaga_kesehatan' => 'integer', 'honorarium_tenaga_kesehatan' => 'decimal:2', 'pendapatan_faskes_swasta' => 'decimal:2',
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
        return $this->hasOne(Rekap::class, 'format3_form4_id');
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
