<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('format6_form4s', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('bencana_id');
            $table->string('nama_kampung');
            $table->string('nama_distrik');
            
            // Sarana Air Minum
            $table->integer('struktur_air_jumlah')->nullable()->default(0);
            $table->decimal('struktur_air_harga', 15, 2)->nullable()->default(0);
            $table->decimal('struktur_air_total', 15, 2)->nullable()->default(0);
            $table->integer('instalasi_pemurnian_jumlah')->nullable()->default(0);
            $table->decimal('instalasi_pemurnian_harga', 15, 2)->nullable()->default(0);
            $table->decimal('instalasi_pemurnian_total', 15, 2)->nullable()->default(0);
            $table->integer('perpipaan_jumlah')->nullable()->default(0);
            $table->decimal('perpipaan_harga', 15, 2)->nullable()->default(0);
            $table->decimal('perpipaan_total', 15, 2)->nullable()->default(0);
            $table->integer('penyimpanan_jumlah')->nullable()->default(0);
            $table->decimal('penyimpanan_harga', 15, 2)->nullable()->default(0);
            $table->decimal('penyimpanan_total', 15, 2)->nullable()->default(0);
            $table->integer('sumur_jumlah')->nullable()->default(0);
            $table->decimal('sumur_harga', 15, 2)->nullable()->default(0);
            $table->decimal('sumur_total', 15, 2)->nullable()->default(0);
            $table->integer('mck_jumlah')->nullable()->default(0);
            $table->decimal('mck_harga', 15, 2)->nullable()->default(0);
            $table->decimal('mck_total', 15, 2)->nullable()->default(0);
            
            // Sistem Sanitasi
            $table->integer('sanitasi_jumlah')->nullable()->default(0);
            $table->decimal('sanitasi_harga', 15, 2)->nullable()->default(0);
            $table->decimal('sanitasi_total', 15, 2)->nullable()->default(0);
            $table->integer('drainase_jumlah')->nullable()->default(0);
            $table->decimal('drainase_harga', 15, 2)->nullable()->default(0);
            $table->decimal('drainase_total', 15, 2)->nullable()->default(0);
            $table->integer('limbah_padat_jumlah')->nullable()->default(0);
            $table->decimal('limbah_padat_harga', 15, 2)->nullable()->default(0);
            $table->decimal('limbah_padat_total', 15, 2)->nullable()->default(0);
            $table->integer('wc_umum_jumlah')->nullable()->default(0);
            $table->decimal('wc_umum_harga', 15, 2)->nullable()->default(0);
            $table->decimal('wc_umum_total', 15, 2)->nullable()->default(0);
            
            // Perkiraan Kerugian
            $table->decimal('kehilangan_pendapatan_pdam', 15, 2)->nullable()->default(0);
            $table->decimal('biaya_pemurnian_air', 15, 2)->nullable()->default(0);
            $table->decimal('biaya_distribusi_air', 15, 2)->nullable()->default(0);
            $table->decimal('biaya_pembersihan_sumur', 15, 2)->nullable()->default(0);
            $table->decimal('biaya_lain_air', 15, 2)->nullable()->default(0);
            $table->decimal('biaya_sanitasi_lain', 15, 2)->nullable()->default(0);
            
            $table->timestamps();
            $table->softDeletes();
            
            // Indexes for better performance
            $table->index('bencana_id');
            $table->index(['nama_kampung', 'nama_distrik']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('format6_form4s');
    }
};
