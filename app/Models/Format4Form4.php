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
        'rumah_hancur_total_permanen',
        'rumah_hancur_total_non_permanen',
        'rumah_rusak_berat_permanen',
        'rumah_rusak_berat_non_permanen',
        'rumah_rusak_sedang_permanen',
        'rumah_rusak_sedang_non_permanen',
        'rumah_rusak_ringan_permanen',
        'rumah_rusak_ringan_non_permanen',
        'harga_satuan_permanen',
        'harga_satuan_non_permanen',
        'jalan_rusak_berat',
        'jalan_rusak_sedang',
        'jalan_rusak_ringan',
        'harga_satuan_jalan',
        'saluran_rusak_berat',
        'saluran_rusak_sedang',
        'saluran_rusak_ringan',
        'harga_satuan_saluran',
        'balai_rusak_berat',
        'balai_rusak_sedang',
        'balai_rusak_ringan',
        'harga_satuan_balai',
        'tenaga_kerja_hok',
        'upah_harian',
        'alat_berat_hari',
        'biaya_per_hari',
        'jumlah_rumah_disewa',
        'harga_sewa_per_bulan',
        'durasi_sewa_bulan',
        'jumlah_tenda',
        'harga_tenda',
        'jumlah_barak',
        'harga_barak',
        'jumlah_rumah_sementara',
        'harga_rumah_sementara',
        'total_kerusakan',
        'total_kerugian',
    ];

    protected $casts = [
        'rumah_hancur_total_permanen' => 'integer',
        'rumah_hancur_total_non_permanen' => 'integer',
        'rumah_rusak_berat_permanen' => 'integer',
        'rumah_rusak_berat_non_permanen' => 'integer',
        'rumah_rusak_sedang_permanen' => 'integer',
        'rumah_rusak_sedang_non_permanen' => 'integer',
        'rumah_rusak_ringan_permanen' => 'integer',
        'rumah_rusak_ringan_non_permanen' => 'integer',
        'harga_satuan_permanen' => 'decimal:2',
        'harga_satuan_non_permanen' => 'decimal:2',
        'jalan_rusak_berat' => 'decimal:2',
        'jalan_rusak_sedang' => 'decimal:2',
        'jalan_rusak_ringan' => 'decimal:2',
        'harga_satuan_jalan' => 'decimal:2',
        'saluran_rusak_berat' => 'decimal:2',
        'saluran_rusak_sedang' => 'decimal:2',
        'saluran_rusak_ringan' => 'decimal:2',
        'harga_satuan_saluran' => 'decimal:2',
        'balai_rusak_berat' => 'integer',
        'balai_rusak_sedang' => 'integer',
        'balai_rusak_ringan' => 'integer',
        'harga_satuan_balai' => 'decimal:2',
        'tenaga_kerja_hok' => 'decimal:2',
        'upah_harian' => 'decimal:2',
        'alat_berat_hari' => 'integer',
        'biaya_per_hari' => 'decimal:2',
        'jumlah_rumah_disewa' => 'integer',
        'harga_sewa_per_bulan' => 'decimal:2',
        'durasi_sewa_bulan' => 'integer',
        'jumlah_tenda' => 'integer',
        'harga_tenda' => 'decimal:2',
        'jumlah_barak' => 'integer',
        'harga_barak' => 'decimal:2',
        'jumlah_rumah_sementara' => 'integer',
        'harga_rumah_sementara' => 'decimal:2',
        'total_kerusakan' => 'decimal:2',
        'total_kerugian' => 'decimal:2',
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
