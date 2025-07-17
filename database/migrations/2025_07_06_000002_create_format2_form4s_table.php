<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('format2_form4s', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('bencana_id')->index();
            $table->string('nama_kampung')->nullable();
            $table->string('nama_distrik')->nullable();
            // TK/RA
            $table->integer('tk_berat_negeri')->nullable();
            $table->integer('tk_berat_swasta')->nullable();
            $table->integer('tk_sedang_negeri')->nullable();
            $table->integer('tk_sedang_swasta')->nullable();
            $table->integer('tk_ringan_negeri')->nullable();
            $table->integer('tk_ringan_swasta')->nullable();
            $table->string('tk_ukuran')->nullable();
            $table->decimal('tk_harga_bangunan', 20, 2)->nullable();
            $table->string('tk_harga_peralatan')->nullable();
            $table->string('tk_harga_meubelair')->nullable();
            // SD/MI
            $table->integer('sd_berat_negeri')->nullable();
            $table->integer('sd_berat_swasta')->nullable();
            $table->integer('sd_sedang_negeri')->nullable();
            $table->integer('sd_sedang_swasta')->nullable();
            $table->integer('sd_ringan_negeri')->nullable();
            $table->integer('sd_ringan_swasta')->nullable();
            $table->string('sd_ukuran')->nullable();
            $table->decimal('sd_harga_bangunan', 20, 2)->nullable();
            $table->string('sd_harga_peralatan')->nullable();
            $table->string('sd_harga_meubelair')->nullable();
            // SMP/MTS
            $table->integer('smp_berat_negeri')->nullable();
            $table->integer('smp_berat_swasta')->nullable();
            $table->integer('smp_sedang_negeri')->nullable();
            $table->integer('smp_sedang_swasta')->nullable();
            $table->integer('smp_ringan_negeri')->nullable();
            $table->integer('smp_ringan_swasta')->nullable();
            $table->string('smp_ukuran')->nullable();
            $table->decimal('smp_harga_bangunan', 20, 2)->nullable();
            $table->string('smp_harga_peralatan')->nullable();
            $table->string('smp_harga_meubelair')->nullable();
            // SMA/MA
            $table->integer('sma_berat_negeri')->nullable();
            $table->integer('sma_berat_swasta')->nullable();
            $table->integer('sma_sedang_negeri')->nullable();
            $table->integer('sma_sedang_swasta')->nullable();
            $table->integer('sma_ringan_negeri')->nullable();
            $table->integer('sma_ringan_swasta')->nullable();
            $table->string('sma_ukuran')->nullable();
            $table->decimal('sma_harga_bangunan', 20, 2)->nullable();
            $table->string('sma_harga_peralatan')->nullable();
            $table->string('sma_harga_meubelair')->nullable();
            // SMK
            $table->integer('smk_berat_negeri')->nullable();
            $table->integer('smk_berat_swasta')->nullable();
            $table->integer('smk_sedang_negeri')->nullable();
            $table->integer('smk_sedang_swasta')->nullable();
            $table->integer('smk_ringan_negeri')->nullable();
            $table->integer('smk_ringan_swasta')->nullable();
            $table->string('smk_ukuran')->nullable();
            $table->decimal('smk_harga_bangunan', 20, 2)->nullable();
            $table->string('smk_harga_peralatan')->nullable();
            $table->string('smk_harga_meubelair')->nullable();
            // Perguruan Tinggi
            $table->integer('pt_berat_negeri')->nullable();
            $table->integer('pt_berat_swasta')->nullable();
            $table->integer('pt_sedang_negeri')->nullable();
            $table->integer('pt_sedang_swasta')->nullable();
            $table->integer('pt_ringan_negeri')->nullable();
            $table->integer('pt_ringan_swasta')->nullable();
            $table->string('pt_ukuran')->nullable();
            $table->decimal('pt_harga_bangunan', 20, 2)->nullable();
            $table->string('pt_harga_peralatan')->nullable();
            $table->string('pt_harga_meubelair')->nullable();
            // Perpustakaan
            $table->integer('perpus_berat_negeri')->nullable();
            $table->integer('perpus_berat_swasta')->nullable();
            $table->integer('perpus_sedang_negeri')->nullable();
            $table->integer('perpus_sedang_swasta')->nullable();
            $table->integer('perpus_ringan_negeri')->nullable();
            $table->integer('perpus_ringan_swasta')->nullable();
            $table->string('perpus_ukuran')->nullable();
            $table->decimal('perpus_harga_bangunan', 20, 2)->nullable();
            $table->string('perpus_harga_peralatan')->nullable();
            $table->string('perpus_harga_meubelair')->nullable();
            // Laboratorium
            $table->integer('lab_berat_negeri')->nullable();
            $table->integer('lab_berat_swasta')->nullable();
            $table->integer('lab_sedang_negeri')->nullable();
            $table->integer('lab_sedang_swasta')->nullable();
            $table->integer('lab_ringan_negeri')->nullable();
            $table->integer('lab_ringan_swasta')->nullable();
            $table->string('lab_ukuran')->nullable();
            $table->decimal('lab_harga_bangunan', 20, 2)->nullable();
            $table->string('lab_harga_peralatan')->nullable();
            $table->string('lab_harga_meubelair')->nullable();
            // Lainnya
            $table->integer('lainnya_berat_negeri')->nullable();
            $table->integer('lainnya_berat_swasta')->nullable();
            $table->integer('lainnya_sedang_negeri')->nullable();
            $table->integer('lainnya_sedang_swasta')->nullable();
            $table->integer('lainnya_ringan_negeri')->nullable();
            $table->integer('lainnya_ringan_swasta')->nullable();
            $table->string('lainnya_ukuran')->nullable();
            $table->decimal('lainnya_harga_bangunan', 20, 2)->nullable();
            $table->string('lainnya_harga_peralatan')->nullable();
            $table->string('lainnya_harga_meubelair')->nullable();
            // Kerugian & info sekolah
            $table->integer('biaya_tenaga_kerja_hok')->nullable();
            $table->decimal('biaya_tenaga_kerja_upah', 20, 2)->nullable();
            $table->integer('biaya_alat_berat_hari')->nullable();
            $table->decimal('biaya_alat_berat_harga', 20, 2)->nullable();
            $table->integer('sekolah_pengungsian')->nullable();
            $table->integer('guru_korban')->nullable();
            $table->decimal('iuran_sekolah', 20, 2)->nullable();
            $table->integer('jumlah_sekolah_sementara')->nullable();
            $table->decimal('harga_sekolah_sementara', 20, 2)->nullable();
            // Rekap
            $table->decimal('total_kerusakan', 20, 2)->nullable()->default(0);
            $table->decimal('total_kerugian', 20, 2)->nullable()->default(0);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('format2_form4s');
    }
};
