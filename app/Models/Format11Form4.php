<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Format11Form4 extends Model
{
    protected $table = 'format11_form4s';
    protected $fillable = [
        'bencana_id',
        'nama_kampung',
        'nama_distrik',
        // Kematian Hewan Ternak
        'kematian_1_jenis', 'kematian_1_unit', 'kematian_1_harga_satuan',
        'kematian_2_jenis', 'kematian_2_unit', 'kematian_2_harga_satuan',
        'kematian_3_jenis', 'kematian_3_unit', 'kematian_3_harga_satuan',
        'kematian_4_jenis', 'kematian_4_unit', 'kematian_4_harga_satuan',
        // Kerusakan Kandang
        'kandang_1_jenis', 'kandang_1_unit', 'kandang_1_harga_satuan',
        'kandang_2_jenis', 'kandang_2_unit', 'kandang_2_harga_satuan',
        'kandang_3_jenis', 'kandang_3_unit', 'kandang_3_harga_satuan',
        // Kerusakan Peralatan Kandang
        'peralatan_1_jenis', 'peralatan_1_unit', 'peralatan_1_harga_satuan',
        'peralatan_2_jenis', 'peralatan_2_unit', 'peralatan_2_harga_satuan',
        'peralatan_3_jenis', 'peralatan_3_unit', 'peralatan_3_harga_satuan',
        // Produksi yang Hilang Total
        'hilang_1_jenis', 'hilang_1_unit', 'hilang_1_harga_satuan',
        'hilang_2_jenis', 'hilang_2_unit', 'hilang_2_harga_satuan',
        'hilang_3_jenis', 'hilang_3_unit', 'hilang_3_harga_satuan',
        // Penurunan Produktifitas
        'produktifitas_1_jenis', 'produktifitas_1_unit', 'produktifitas_1_harga_satuan',
        'produktifitas_2_jenis', 'produktifitas_2_unit', 'produktifitas_2_harga_satuan',
        'produktifitas_3_jenis', 'produktifitas_3_unit', 'produktifitas_3_harga_satuan',
        // Kenaikan Ongkos Produksi
        'ongkos_1_jenis', 'ongkos_1_unit', 'ongkos_1_harga_satuan',
        'ongkos_2_jenis', 'ongkos_2_unit', 'ongkos_2_harga_satuan',
        'ongkos_3_jenis', 'ongkos_3_unit', 'ongkos_3_harga_satuan',
        // Total
        'total_kerusakan',
        'total_kerugian',
    ];
    protected $casts = [
        'kematian_1_unit' => 'integer', 'kematian_1_harga_satuan' => 'decimal:2',
        'kematian_2_unit' => 'integer', 'kematian_2_harga_satuan' => 'decimal:2',
        'kematian_3_unit' => 'integer', 'kematian_3_harga_satuan' => 'decimal:2',
        'kematian_4_unit' => 'integer', 'kematian_4_harga_satuan' => 'decimal:2',
        'kandang_1_unit' => 'integer', 'kandang_1_harga_satuan' => 'decimal:2',
        'kandang_2_unit' => 'integer', 'kandang_2_harga_satuan' => 'decimal:2',
        'kandang_3_unit' => 'integer', 'kandang_3_harga_satuan' => 'decimal:2',
        'peralatan_1_unit' => 'integer', 'peralatan_1_harga_satuan' => 'decimal:2',
        'peralatan_2_unit' => 'integer', 'peralatan_2_harga_satuan' => 'decimal:2',
        'peralatan_3_unit' => 'integer', 'peralatan_3_harga_satuan' => 'decimal:2',
        'hilang_1_unit' => 'integer', 'hilang_1_harga_satuan' => 'decimal:2',
        'hilang_2_unit' => 'integer', 'hilang_2_harga_satuan' => 'decimal:2',
        'hilang_3_unit' => 'integer', 'hilang_3_harga_satuan' => 'decimal:2',
        'produktifitas_1_unit' => 'integer', 'produktifitas_1_harga_satuan' => 'decimal:2',
        'produktifitas_2_unit' => 'integer', 'produktifitas_2_harga_satuan' => 'decimal:2',
        'produktifitas_3_unit' => 'integer', 'produktifitas_3_harga_satuan' => 'decimal:2',
        'ongkos_1_unit' => 'integer', 'ongkos_1_harga_satuan' => 'decimal:2',
        'ongkos_2_unit' => 'integer', 'ongkos_2_harga_satuan' => 'decimal:2',
        'ongkos_3_unit' => 'integer', 'ongkos_3_harga_satuan' => 'decimal:2',
        'total_kerusakan' => 'decimal:2',
        'total_kerugian' => 'decimal:2',
    ];

    /**
     * Get the bencana that owns the Format11Form4.
     */
    public function bencana(): BelongsTo
    {
        return $this->belongsTo(Bencana::class);
    }
}
