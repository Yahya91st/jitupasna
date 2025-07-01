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
        Schema::create('format5_form4s', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('bencana_id');
            $table->string('nama_kampung');
            $table->string('nama_distrik');
            
            // Gereja - Kerusakan Bangunan Ibadah
            $table->integer('gereja_rb_negeri')->nullable()->default(0);
            $table->integer('gereja_rb_swasta')->nullable()->default(0);
            $table->integer('gereja_rs_negeri')->nullable()->default(0);
            $table->integer('gereja_rs_swasta')->nullable()->default(0);
            $table->integer('gereja_rr_negeri')->nullable()->default(0);
            $table->integer('gereja_rr_swasta')->nullable()->default(0);
            $table->decimal('gereja_luas', 10, 2)->nullable()->default(0);
            $table->decimal('gereja_harga_bangunan', 15, 2)->nullable()->default(0);
            $table->decimal('gereja_harga_peralatan', 15, 2)->nullable()->default(0);
            
            // Kapel - Kerusakan Bangunan Ibadah  
            $table->integer('kapel_rb_negeri')->nullable()->default(0);
            $table->integer('kapel_rb_swasta')->nullable()->default(0);
            $table->integer('kapel_rs_negeri')->nullable()->default(0);
            $table->integer('kapel_rs_swasta')->nullable()->default(0);
            $table->integer('kapel_rr_negeri')->nullable()->default(0);
            $table->integer('kapel_rr_swasta')->nullable()->default(0);
            $table->decimal('kapel_luas', 10, 2)->nullable()->default(0);
            $table->decimal('kapel_harga_bangunan', 15, 2)->nullable()->default(0);
            $table->decimal('kapel_harga_peralatan', 15, 2)->nullable()->default(0);
            
            // Masjid - Kerusakan Bangunan Ibadah
            $table->integer('masjid_rb_negeri')->nullable()->default(0);
            $table->integer('masjid_rb_swasta')->nullable()->default(0);
            $table->integer('masjid_rs_negeri')->nullable()->default(0);
            $table->integer('masjid_rs_swasta')->nullable()->default(0);
            $table->integer('masjid_rr_negeri')->nullable()->default(0);
            $table->integer('masjid_rr_swasta')->nullable()->default(0);
            $table->decimal('masjid_luas', 10, 2)->nullable()->default(0);
            $table->decimal('masjid_harga_bangunan', 15, 2)->nullable()->default(0);
            $table->decimal('masjid_harga_peralatan', 15, 2)->nullable()->default(0);
            
            // Musholla - Kerusakan Bangunan Ibadah
            $table->integer('musholla_rb_negeri')->nullable()->default(0);
            $table->integer('musholla_rb_swasta')->nullable()->default(0);
            $table->integer('musholla_rs_negeri')->nullable()->default(0);
            $table->integer('musholla_rs_swasta')->nullable()->default(0);
            $table->integer('musholla_rr_negeri')->nullable()->default(0);
            $table->integer('musholla_rr_swasta')->nullable()->default(0);
            $table->decimal('musholla_luas', 10, 2)->nullable()->default(0);
            $table->decimal('musholla_harga_bangunan', 15, 2)->nullable()->default(0);
            $table->decimal('musholla_harga_peralatan', 15, 2)->nullable()->default(0);
            
            // Pura - Kerusakan Bangunan Ibadah
            $table->integer('pura_rb_negeri')->nullable()->default(0);
            $table->integer('pura_rb_swasta')->nullable()->default(0);
            $table->integer('pura_rs_negeri')->nullable()->default(0);
            $table->integer('pura_rs_swasta')->nullable()->default(0);
            $table->integer('pura_rr_negeri')->nullable()->default(0);
            $table->integer('pura_rr_swasta')->nullable()->default(0);
            $table->decimal('pura_luas', 10, 2)->nullable()->default(0);
            $table->decimal('pura_harga_bangunan', 15, 2)->nullable()->default(0);
            $table->decimal('pura_harga_peralatan', 15, 2)->nullable()->default(0);
            
            // Vihara - Kerusakan Bangunan Ibadah
            $table->integer('vihara_rb_negeri')->nullable()->default(0);
            $table->integer('vihara_rb_swasta')->nullable()->default(0);
            $table->integer('vihara_rs_negeri')->nullable()->default(0);
            $table->integer('vihara_rs_swasta')->nullable()->default(0);
            $table->integer('vihara_rr_negeri')->nullable()->default(0);
            $table->integer('vihara_rr_swasta')->nullable()->default(0);
            $table->decimal('vihara_luas', 10, 2)->nullable()->default(0);
            $table->decimal('vihara_harga_bangunan', 15, 2)->nullable()->default(0);
            $table->decimal('vihara_harga_peralatan', 15, 2)->nullable()->default(0);
            
            // Biaya Pembersihan Puing
            $table->decimal('biaya_tenaga_kerja_hok', 10, 2)->nullable()->default(0);
            $table->decimal('biaya_tenaga_kerja_upah', 15, 2)->nullable()->default(0);
            $table->decimal('biaya_alat_berat_hari', 10, 2)->nullable()->default(0);
            $table->decimal('biaya_alat_berat_harga', 15, 2)->nullable()->default(0);
            
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
        Schema::dropIfExists('format5_form4s');
    }
};
