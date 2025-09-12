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

    // Calculate total kerusakan (damage) - now includes all kerugian items moved from losses
    public function calculateTotalKerusakan()
    {
        $faskes = ['rs', 'puskesmas', 'poliklinik', 'pustu', 'polindes', 'posyandu'];
        $totalKerusakan = 0;
        
        // 1. Kerusakan bangunan fasilitas kesehatan
        foreach ($faskes as $f) {
            // Rusak berat 
            $totalKerusakan += (($this->{$f.'_rb_negeri'} ?? 0) + ($this->{$f.'_rb_swasta'} ?? 0)) * ($this->{$f.'_harga_bangunan'} ?? 0);
            // Rusak sedang
            $totalKerusakan += (($this->{$f.'_rs_negeri'} ?? 0) + ($this->{$f.'_rs_swasta'} ?? 0)) * ($this->{$f.'_harga_bangunan'} ?? 0);
            // Rusak ringan
            $totalKerusakan += (($this->{$f.'_rr_negeri'} ?? 0) + ($this->{$f.'_rr_swasta'} ?? 0)) * ($this->{$f.'_harga_bangunan'} ?? 0);
        }
        
        // 2. Biaya pembersihan puing (dipindahkan dari kerugian ke kerusakan)
        $totalKerusakan += ($this->biaya_tenaga_kerja_hok ?? 0) * ($this->biaya_tenaga_kerja_upah ?? 0);
        $totalKerusakan += ($this->biaya_alat_berat_hari ?? 0) * ($this->biaya_alat_berat_harga ?? 0);
        
        // 3. Biaya pemulasaraan jenazah (dipindahkan dari kerugian ke kerusakan)
        $totalKerusakan += ($this->jumlah_jenazah ?? 0) * ($this->biaya_per_jenazah ?? 0);
        
        // 4. Biaya perawatan korban bencana (dipindahkan dari kerugian ke kerusakan)
        $totalKerusakan += ($this->jumlah_pasien ?? 0) * ($this->biaya_per_pasien ?? 0);
        
        // 5. Biaya faskes sementara (dipindahkan dari kerugian ke kerusakan)
        $totalKerusakan += ($this->jumlah_faskes ?? 0) * ($this->biaya_pengadaan_faskes ?? 0);
        
        // 6. Biaya penanganan psikologis (dipindahkan dari kerugian ke kerusakan)
        $totalKerusakan += ($this->jumlah_korban_psikologis ?? 0) * ($this->biaya_penanganan_psikologis ?? 0);
        
        // 7. Biaya pencegahan penyakit menular (dipindahkan dari kerugian ke kerusakan)
        $totalKerusakan += ($this->biaya_pencegahan_penyakit ?? 0);
        
        // 8. Biaya honorarium tenaga kesehatan (dipindahkan dari kerugian ke kerusakan)
        $totalKerusakan += ($this->jumlah_tenaga_kesehatan ?? 0) * ($this->honorarium_tenaga_kesehatan ?? 0);
        
        // 9. Pendapatan faskes swasta (dipindahkan dari kerugian ke kerusakan)
        $totalKerusakan += ($this->pendapatan_faskes_swasta ?? 0);

        return $totalKerusakan;
    }

    // Calculate total kerugian (losses) - now returns 0 since all moved to kerusakan
    public function calculateTotalKerugian()
    {
        // All kerugian items have been moved to kerusakan calculation
        return 0;
    }
}
