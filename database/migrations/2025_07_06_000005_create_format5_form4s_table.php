<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('format5_form4s', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('bencana_id')->index();
            $table->string('nama_kampung')->nullable();
            $table->string('nama_distrik')->nullable();
            // Gereja
            $table->integer('gereja_rb_negeri')->nullable();
            $table->integer('gereja_rb_swasta')->nullable();
            $table->integer('gereja_rs_negeri')->nullable();
            $table->integer('gereja_rs_swasta')->nullable();
            $table->integer('gereja_rr_negeri')->nullable();
            $table->integer('gereja_rr_swasta')->nullable();
            $table->decimal('gereja_luas', 12, 2)->nullable();
            $table->decimal('gereja_harga_bangunan', 18, 2)->nullable();
            $table->decimal('gereja_harga_peralatan', 18, 2)->nullable();
            // Kapel
            $table->integer('kapel_rb_negeri')->nullable();
            $table->integer('kapel_rb_swasta')->nullable();
            $table->integer('kapel_rs_negeri')->nullable();
            $table->integer('kapel_rs_swasta')->nullable();
            $table->integer('kapel_rr_negeri')->nullable();
            $table->integer('kapel_rr_swasta')->nullable();
            $table->decimal('kapel_luas', 12, 2)->nullable();
            $table->decimal('kapel_harga_bangunan', 18, 2)->nullable();
            $table->decimal('kapel_harga_peralatan', 18, 2)->nullable();
            // Masjid
            $table->integer('masjid_rb_negeri')->nullable();
            $table->integer('masjid_rb_swasta')->nullable();
            $table->integer('masjid_rs_negeri')->nullable();
            $table->integer('masjid_rs_swasta')->nullable();
            $table->integer('masjid_rr_negeri')->nullable();
            $table->integer('masjid_rr_swasta')->nullable();
            $table->decimal('masjid_luas', 12, 2)->nullable();
            $table->decimal('masjid_harga_bangunan', 18, 2)->nullable();
            $table->decimal('masjid_harga_peralatan', 18, 2)->nullable();
            // Musholla
            $table->integer('musholla_rb_negeri')->nullable();
            $table->integer('musholla_rb_swasta')->nullable();
            $table->integer('musholla_rs_negeri')->nullable();
            $table->integer('musholla_rs_swasta')->nullable();
            $table->integer('musholla_rr_negeri')->nullable();
            $table->integer('musholla_rr_swasta')->nullable();
            $table->decimal('musholla_luas', 12, 2)->nullable();
            $table->decimal('musholla_harga_bangunan', 18, 2)->nullable();
            $table->decimal('musholla_harga_peralatan', 18, 2)->nullable();
            // Pura
            $table->integer('pura_rb_negeri')->nullable();
            $table->integer('pura_rb_swasta')->nullable();
            $table->integer('pura_rs_negeri')->nullable();
            $table->integer('pura_rs_swasta')->nullable();
            $table->integer('pura_rr_negeri')->nullable();
            $table->integer('pura_rr_swasta')->nullable();
            $table->decimal('pura_luas', 12, 2)->nullable();
            $table->decimal('pura_harga_bangunan', 18, 2)->nullable();
            $table->decimal('pura_harga_peralatan', 18, 2)->nullable();
            // Vihara
            $table->integer('vihara_rb_negeri')->nullable();
            $table->integer('vihara_rb_swasta')->nullable();
            $table->integer('vihara_rs_negeri')->nullable();
            $table->integer('vihara_rs_swasta')->nullable();
            $table->integer('vihara_rr_negeri')->nullable();
            $table->integer('vihara_rr_swasta')->nullable();
            $table->decimal('vihara_luas', 12, 2)->nullable();
            $table->decimal('vihara_harga_bangunan', 18, 2)->nullable();
            $table->decimal('vihara_harga_peralatan', 18, 2)->nullable();
            // Kerugian
            $table->decimal('biaya_tenaga_kerja_hok', 18, 2)->nullable();
            $table->decimal('biaya_tenaga_kerja_upah', 18, 2)->nullable();
            $table->integer('biaya_alat_berat_hari')->nullable();
            $table->decimal('biaya_alat_berat_harga', 18, 2)->nullable();
            // Total
            $table->decimal('total_kerusakan', 20, 2)->nullable()->default(0);
            $table->decimal('total_kerugian', 20, 2)->nullable()->default(0);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('format5_form4s');
    }
};
