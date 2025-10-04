<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Format9Form4 extends Model
{
    protected $table = 'format9_form4s';
    protected $fillable = [
        'bencana_id',
        'nama_kampung',
        'nama_distrik',
        // Kerusakan Sarana dan Prasarana
        'kerusakan_1_nama', 'kerusakan_1_satuan', 'kerusakan_1_jumlah_unit', 'kerusakan_1_harga_satuan',
        'kerusakan_2_nama', 'kerusakan_2_satuan', 'kerusakan_2_jumlah_unit', 'kerusakan_2_harga_satuan',
        'kerusakan_3_nama', 'kerusakan_3_satuan', 'kerusakan_3_jumlah_unit', 'kerusakan_3_harga_satuan',
        'kerusakan_4_nama', 'kerusakan_4_satuan', 'kerusakan_4_jumlah_unit', 'kerusakan_4_harga_satuan',
        // Perkiraan Jangka Waktu Pemulihan
        'jangka_waktu_pemulihan_a', 'jangka_waktu_satuan', 'jangka_waktu_unit', 'jangka_waktu_harga_satuan',
        // Perkiraan Kehilangan Pendapatan
        'permintaan_sebelum_satuan', 'permintaan_sebelum_unit', 'permintaan_sebelum_harga_satuan',
        'permintaan_pasca_satuan', 'permintaan_pasca_unit', 'permintaan_pasca_harga_satuan',
        'tarif_satuan', 'tarif_unit', 'tarif_harga_satuan',
        'penurunan_pendapatan_satuan', 'penurunan_pendapatan_unit', 'penurunan_pendapatan_harga_satuan',
        // Perkiraan Kenaikan Biaya Operasional
        'biaya_operasional_sebelum_satuan', 'biaya_operasional_sebelum_unit', 'biaya_operasional_sebelum_harga_satuan',
        'biaya_operasional_pasca_satuan', 'biaya_operasional_pasca_unit', 'biaya_operasional_pasca_harga_satuan',
        'kenaikan_biaya_operasional_satuan', 'kenaikan_biaya_operasional_unit', 'kenaikan_biaya_operasional_harga_satuan',
        // Total
        'total_kerusakan',
        'total_kerugian',
    ];
    protected $casts = [
        'kerusakan_1_jumlah_unit' => 'integer', 'kerusakan_1_harga_satuan' => 'decimal:2',
        'kerusakan_2_jumlah_unit' => 'integer', 'kerusakan_2_harga_satuan' => 'decimal:2',
        'kerusakan_3_jumlah_unit' => 'integer', 'kerusakan_3_harga_satuan' => 'decimal:2',
        'kerusakan_4_jumlah_unit' => 'integer', 'kerusakan_4_harga_satuan' => 'decimal:2',
        'jangka_waktu_pemulihan_a' => 'integer', 'jangka_waktu_unit' => 'integer', 'jangka_waktu_harga_satuan' => 'decimal:2',
        'permintaan_sebelum_unit' => 'integer', 'permintaan_sebelum_harga_satuan' => 'decimal:2',
        'permintaan_pasca_unit' => 'integer', 'permintaan_pasca_harga_satuan' => 'decimal:2',
        'tarif_unit' => 'integer', 'tarif_harga_satuan' => 'decimal:2',
        'penurunan_pendapatan_unit' => 'integer', 'penurunan_pendapatan_harga_satuan' => 'decimal:2',
        'biaya_operasional_sebelum_unit' => 'integer', 'biaya_operasional_sebelum_harga_satuan' => 'decimal:2',
        'biaya_operasional_pasca_unit' => 'integer', 'biaya_operasional_pasca_harga_satuan' => 'decimal:2',
        'kenaikan_biaya_operasional_unit' => 'integer', 'kenaikan_biaya_operasional_harga_satuan' => 'decimal:2',
        'total_kerusakan' => 'decimal:2',
        'total_kerugian' => 'decimal:2',
    ];

    protected static function boot()
    {
        parent::boot();
        static::saving(function ($format9) {
            // Simpan hasil perkalian ke *_jumlah_unit
            $format9->kerusakan_1_jumlah_unit = ($format9->kerusakan_1_satuan ?? 0) * ($format9->kerusakan_1_harga_satuan ?? 0);
            $format9->kerusakan_2_jumlah_unit = ($format9->kerusakan_2_satuan ?? 0) * ($format9->kerusakan_2_harga_satuan ?? 0);
            $format9->kerusakan_3_jumlah_unit = ($format9->kerusakan_3_satuan ?? 0) * ($format9->kerusakan_3_harga_satuan ?? 0);
            $format9->kerusakan_4_jumlah_unit = ($format9->kerusakan_4_satuan ?? 0) * ($format9->kerusakan_4_harga_satuan ?? 0);
        });
    }

    // Jika ingin tetap menampilkan jumlah, gunakan accessor berikut:
    public function getKerusakan1JumlahAttribute() {
        return ($this->kerusakan_1_satuan ?? 0) * ($this->kerusakan_1_harga_satuan ?? 0);
    }
    public function getKerusakan2JumlahAttribute() {
        return ($this->kerusakan_2_satuan ?? 0) * ($this->kerusakan_2_harga_satuan ?? 0);
    }
    public function getKerusakan3JumlahAttribute() {
        return ($this->kerusakan_3_satuan ?? 0) * ($this->kerusakan_3_harga_satuan ?? 0);
    }
    public function getKerusakan4JumlahAttribute() {
        return ($this->kerusakan_4_satuan ?? 0) * ($this->kerusakan_4_harga_satuan ?? 0);
    }

    /**
     * Calculate total damage from all kerusakan items
     */
    public function getTotalDamage()
    {
        return ($this->kerusakan_1_satuan ?? 0) * ($this->kerusakan_1_harga_satuan ?? 0) +
               ($this->kerusakan_2_satuan ?? 0) * ($this->kerusakan_2_harga_satuan ?? 0) +
               ($this->kerusakan_3_satuan ?? 0) * ($this->kerusakan_3_harga_satuan ?? 0) +
               ($this->kerusakan_4_satuan ?? 0) * ($this->kerusakan_4_harga_satuan ?? 0);
    }

    /**
     * Calculate total loss from pendapatan and biaya operasional
     */
    public function getTotalLoss()
    {
        $penurunanPendapatan = ($this->penurunan_pendapatan_unit ?? 0) * ($this->penurunan_pendapatan_harga_satuan ?? 0);
        $kenaikanBiaya = ($this->kenaikan_biaya_operasional_unit ?? 0) * ($this->kenaikan_biaya_operasional_harga_satuan ?? 0);
        
        return $penurunanPendapatan + $kenaikanBiaya;
    }

    /**
     * Get the bencana that owns the Format9Form4.
     */
    public function bencana(): BelongsTo
    {
        return $this->belongsTo(Bencana::class);
    }
}
