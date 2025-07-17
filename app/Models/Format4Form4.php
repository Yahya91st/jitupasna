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
