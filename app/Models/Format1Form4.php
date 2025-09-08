<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;
use App\Services\RekapAutoSyncService;

class Format1Form4 extends Model
{
    use HasFactory;

    protected $table = 'format1_form4s';

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
        'harga_satuan_hancur_total_permanen',
        'harga_satuan_hancur_total_non_permanen',
        'harga_satuan_rusak_berat_permanen',
        'harga_satuan_rusak_berat_non_permanen',
        'harga_satuan_rusak_sedang_permanen',
        'harga_satuan_rusak_sedang_non_permanen',
        'harga_satuan_rusak_ringan_permanen',
        'harga_satuan_rusak_ringan_non_permanen',
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
        'tenaga_kerja_hok' => 'integer',
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
    ];

    /**
     * Boot method to add model events for auto-sync
     */
    protected static function boot()
    {
        parent::boot();

        // Auto-sync rekap when Format1Form4 is created
        static::created(function ($format1) {
            try {
                $rekapService = new RekapAutoSyncService();
                $rekapService->syncRekapForBencana(
                    $format1->bencana_id,
                    $format1->nama_kampung,
                    $format1->nama_distrik
                );
            } catch (\Exception $e) {
                Log::error("Failed to auto-sync rekap on Format1Form4 creation: " . $e->getMessage());
            }
        });

        // Auto-sync rekap when Format1Form4 is updated
        static::updated(function ($format1) {
            try {
                $rekapService = new RekapAutoSyncService();
                $rekapService->syncRekapForBencana(
                    $format1->bencana_id,
                    $format1->nama_kampung,
                    $format1->nama_distrik
                );
            } catch (\Exception $e) {
                Log::error("Failed to auto-sync rekap on Format1Form4 update: " . $e->getMessage());
            }
        });

        // Handle rekap when Format1Form4 is deleted
        static::deleted(function ($format1) {
            try {
                $rekapService = new RekapAutoSyncService();
                $rekapService->handleFormatDeletion(
                    $format1->bencana_id,
                    $format1->nama_kampung,
                    $format1->nama_distrik,
                    1 // Format 1
                );
            } catch (\Exception $e) {
                Log::error("Failed to handle rekap on Format1Form4 deletion: " . $e->getMessage());
            }
        });
    }

    /**
     * Get the bencana that owns this form data
     */
    public function bencana()
    {
        return $this->belongsTo(Bencana::class);
    }

    /**
     * Calculate total houses damaged
     */
    public function getTotalRumahHancurAttribute()
    {
        return ($this->rumah_hancur_total_permanen ?? 0) + ($this->rumah_hancur_total_non_permanen ?? 0);
    }

    /**
     * Calculate total cost estimation for damaged houses
     */
    public function getTotalEstimasiKerusakanRumahAttribute()
    {
        $total_permanen = ($this->rumah_hancur_total_permanen ?? 0) * ($this->harga_satuan_permanen ?? 0);
        $total_non_permanen = ($this->rumah_hancur_total_non_permanen ?? 0) * ($this->harga_satuan_non_permanen ?? 0);
        
        return $total_permanen + $total_non_permanen;
    }

    /**
     * Calculate total infrastructure damage cost
     */
    public function getTotalEstimasiKerusakanInfrastrukturAttribute()
    {
        $total_jalan = (($this->jalan_rusak_berat ?? 0) + ($this->jalan_rusak_sedang ?? 0) + ($this->jalan_rusak_ringan ?? 0)) * ($this->harga_satuan_jalan ?? 0);
        $total_saluran = (($this->saluran_rusak_berat ?? 0) + ($this->saluran_rusak_sedang ?? 0) + ($this->saluran_rusak_ringan ?? 0)) * ($this->harga_satuan_saluran ?? 0);
        $total_balai = (($this->balai_rusak_berat ?? 0) + ($this->balai_rusak_sedang ?? 0) + ($this->balai_rusak_ringan ?? 0)) * ($this->harga_satuan_balai ?? 0);
        
        return $total_jalan + $total_saluran + $total_balai;
    }

    /**
     * Calculate grand total for this format (used by Rekap)
     */
    public function getGrandTotalAttribute()
    {
        $rumah_kerusakan = $this->total_estimasi_kerusakan_rumah;
        $infrastruktur_kerusakan = $this->total_estimasi_kerusakan_infrastruktur;
        
        // Add temporary housing and work costs
        $rumah_sewa = ($this->jumlah_rumah_disewa ?? 0) * ($this->harga_sewa_per_bulan ?? 0) * ($this->durasi_sewa_bulan ?? 0);
        $tenda = ($this->jumlah_tenda ?? 0) * ($this->harga_tenda ?? 0);
        $barak = ($this->jumlah_barak ?? 0) * ($this->harga_barak ?? 0);
        $rumah_sementara = ($this->jumlah_rumah_sementara ?? 0) * ($this->harga_rumah_sementara ?? 0);
        $tenaga_kerja = ($this->tenaga_kerja_hok ?? 0) * ($this->upah_harian ?? 0);
        $alat_berat = ($this->alat_berat_hari ?? 0) * ($this->biaya_per_hari ?? 0);
        
        return $rumah_kerusakan + $infrastruktur_kerusakan + $rumah_sewa + $tenda + $barak + $rumah_sementara + $tenaga_kerja + $alat_berat;
    }

    /**
     * Calculate total kerugian for this format (used by Rekap)
     */
    public function getTotalKerugianAttribute()
    {
        // For Format 1, kerugian includes temporary costs
        $rumah_sewa = ($this->jumlah_rumah_disewa ?? 0) * ($this->harga_sewa_per_bulan ?? 0) * ($this->durasi_sewa_bulan ?? 0);
        $tenda = ($this->jumlah_tenda ?? 0) * ($this->harga_tenda ?? 0);
        $barak = ($this->jumlah_barak ?? 0) * ($this->harga_barak ?? 0);
        $rumah_sementara = ($this->jumlah_rumah_sementara ?? 0) * ($this->harga_rumah_sementara ?? 0);
        
        return $rumah_sewa + $tenda + $barak + $rumah_sementara;
    }
}
