<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('format3_form4s', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('bencana_id')->index();
            $table->string('nama_kampung')->nullable();
            $table->string('nama_distrik')->nullable();
            // Rumah Sakit
            $table->integer('rs_rb_negeri')->nullable();
            $table->integer('rs_rb_swasta')->nullable();
            $table->integer('rs_rs_negeri')->nullable();
            $table->integer('rs_rs_swasta')->nullable();
            $table->integer('rs_rr_negeri')->nullable();
            $table->integer('rs_rr_swasta')->nullable();
            $table->decimal('rs_luas', 12, 2)->nullable();
            $table->decimal('rs_harga_bangunan', 18, 2)->nullable();
            $table->string('rs_harga_obat')->nullable();
            $table->string('rs_harga_meubelair')->nullable();
            $table->string('rs_harga_peralatan')->nullable();
            // Puskesmas
            $table->integer('puskesmas_rb_negeri')->nullable();
            $table->integer('puskesmas_rb_swasta')->nullable();
            $table->integer('puskesmas_rs_negeri')->nullable();
            $table->integer('puskesmas_rs_swasta')->nullable();
            $table->integer('puskesmas_rr_negeri')->nullable();
            $table->integer('puskesmas_rr_swasta')->nullable();
            $table->decimal('puskesmas_luas', 12, 2)->nullable();
            $table->decimal('puskesmas_harga_bangunan', 18, 2)->nullable();
            $table->string('puskesmas_harga_obat')->nullable();
            $table->string('puskesmas_harga_meubelair')->nullable();
            $table->string('puskesmas_harga_peralatan')->nullable();
            // Poliklinik
            $table->integer('poliklinik_rb_negeri')->nullable();
            $table->integer('poliklinik_rb_swasta')->nullable();
            $table->integer('poliklinik_rs_negeri')->nullable();
            $table->integer('poliklinik_rs_swasta')->nullable();
            $table->integer('poliklinik_rr_negeri')->nullable();
            $table->integer('poliklinik_rr_swasta')->nullable();
            $table->decimal('poliklinik_luas', 12, 2)->nullable();
            $table->decimal('poliklinik_harga_bangunan', 18, 2)->nullable();
            $table->string('poliklinik_harga_obat')->nullable();
            $table->string('poliklinik_harga_meubelair')->nullable();
            $table->string('poliklinik_harga_peralatan')->nullable();
            // Puskesmas Pembantu
            $table->integer('pustu_rb_negeri')->nullable();
            $table->integer('pustu_rb_swasta')->nullable();
            $table->integer('pustu_rs_negeri')->nullable();
            $table->integer('pustu_rs_swasta')->nullable();
            $table->integer('pustu_rr_negeri')->nullable();
            $table->integer('pustu_rr_swasta')->nullable();
            $table->decimal('pustu_luas', 12, 2)->nullable();
            $table->decimal('pustu_harga_bangunan', 18, 2)->nullable();
            $table->string('pustu_harga_obat')->nullable();
            $table->string('pustu_harga_meubelair')->nullable();
            $table->string('pustu_harga_peralatan')->nullable();
            // Polindes
            $table->integer('polindes_rb_negeri')->nullable();
            $table->integer('polindes_rb_swasta')->nullable();
            $table->integer('polindes_rs_negeri')->nullable();
            $table->integer('polindes_rs_swasta')->nullable();
            $table->integer('polindes_rr_negeri')->nullable();
            $table->integer('polindes_rr_swasta')->nullable();
            $table->decimal('polindes_luas', 12, 2)->nullable();
            $table->decimal('polindes_harga_bangunan', 18, 2)->nullable();
            $table->string('polindes_harga_obat')->nullable();
            $table->string('polindes_harga_meubelair')->nullable();
            $table->string('polindes_harga_peralatan')->nullable();
            // Posyandu
            $table->integer('posyandu_rb_negeri')->nullable();
            $table->integer('posyandu_rb_swasta')->nullable();
            $table->integer('posyandu_rs_negeri')->nullable();
            $table->integer('posyandu_rs_swasta')->nullable();
            $table->integer('posyandu_rr_negeri')->nullable();
            $table->integer('posyandu_rr_swasta')->nullable();
            $table->decimal('posyandu_luas', 12, 2)->nullable();
            $table->decimal('posyandu_harga_bangunan', 18, 2)->nullable();
            $table->string('posyandu_harga_obat')->nullable();
            $table->string('posyandu_harga_meubelair')->nullable();
            $table->string('posyandu_harga_peralatan')->nullable();
            // Kerugian
            $table->decimal('biaya_tenaga_kerja_hok', 18, 2)->nullable();
            $table->decimal('biaya_tenaga_kerja_upah', 18, 2)->nullable();
            $table->integer('biaya_alat_berat_hari')->nullable();
            $table->decimal('biaya_alat_berat_harga', 18, 2)->nullable();
            $table->integer('jumlah_jenazah')->nullable();
            $table->decimal('biaya_per_jenazah', 18, 2)->nullable();
            $table->integer('jumlah_pasien')->nullable();
            $table->decimal('biaya_per_pasien', 18, 2)->nullable();
            $table->string('jenis_operasional')->nullable();
            $table->integer('jumlah_faskes')->nullable();
            $table->decimal('biaya_pengadaan_faskes', 18, 2)->nullable();
            $table->integer('jumlah_korban_psikologis')->nullable();
            $table->decimal('biaya_penanganan_psikologis', 18, 2)->nullable();
            $table->decimal('biaya_pencegahan_penyakit', 18, 2)->nullable();
            $table->integer('jumlah_tenaga_kesehatan')->nullable();
            $table->decimal('honorarium_tenaga_kesehatan', 18, 2)->nullable();
            $table->decimal('pendapatan_faskes_swasta', 18, 2)->nullable();
            // Total
            $table->decimal('total_kerusakan', 20, 2)->nullable()->default(0);
            $table->decimal('total_kerugian', 20, 2)->nullable()->default(0);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('format3_form4s');
    }
};
