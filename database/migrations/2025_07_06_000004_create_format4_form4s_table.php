<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('format4_form4s', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('bencana_id')->index();
            $table->string('nama_kampung')->nullable();
            $table->string('nama_distrik')->nullable();
            // Panti Asuhan
            $table->integer('panti_sosial_rb_negeri')->nullable();
            $table->integer('panti_sosial_rb_swasta')->nullable();
            $table->integer('panti_sosial_rs_negeri')->nullable();
            $table->integer('panti_sosial_rs_swasta')->nullable();
            $table->integer('panti_sosial_rr_negeri')->nullable();
            $table->integer('panti_sosial_rr_swasta')->nullable();
            $table->string('panti_sosial_luas')->nullable();
            $table->decimal('panti_sosial_harga_bangunan', 18, 2)->nullable();
            $table->string('panti_sosial_harga_peralatan')->nullable();
            $table->string('panti_sosial_harga_meubelair')->nullable();
            $table->string('panti_sosial_harga_peralatan_lab')->nullable();
            // Panti Wredha
            $table->integer('panti_asuhan_rb_negeri')->nullable();
            $table->integer('panti_asuhan_rb_swasta')->nullable();
            $table->integer('panti_asuhan_rs_negeri')->nullable();
            $table->integer('panti_asuhan_rs_swasta')->nullable();
            $table->integer('panti_asuhan_rr_negeri')->nullable();
            $table->integer('panti_asuhan_rr_swasta')->nullable();
            $table->string('panti_asuhan_luas')->nullable();
            $table->decimal('panti_asuhan_harga_bangunan', 18, 2)->nullable();
            $table->string('panti_asuhan_harga_peralatan')->nullable();
            $table->string('panti_asuhan_harga_meubelair')->nullable();
            $table->string('panti_asuhan_harga_peralatan_lab')->nullable();
            // Balai Pelayanan
            $table->integer('balai_pelayanan_rb_negeri')->nullable();
            $table->integer('balai_pelayanan_rb_swasta')->nullable();
            $table->integer('balai_pelayanan_rs_negeri')->nullable();
            $table->integer('balai_pelayanan_rs_swasta')->nullable();
            $table->integer('balai_pelayanan_rr_negeri')->nullable();
            $table->integer('balai_pelayanan_rr_swasta')->nullable();
            $table->string('balai_pelayanan_luas')->nullable();
            $table->decimal('balai_pelayanan_harga_bangunan', 18, 2)->nullable();
            $table->string('balai_pelayanan_harga_peralatan')->nullable();
            $table->string('balai_pelayanan_harga_meubelair')->nullable();
            $table->string('balai_pelayanan_harga_peralatan_lab')->nullable();
            // Lainnya
            $table->string('lainnya_jenis')->nullable();
            $table->integer('lainnya_rb_negeri')->nullable();
            $table->integer('lainnya_rb_swasta')->nullable();
            $table->integer('lainnya_rs_negeri')->nullable();
            $table->integer('lainnya_rs_swasta')->nullable();
            $table->integer('lainnya_rr_negeri')->nullable();
            $table->integer('lainnya_rr_swasta')->nullable();
            $table->string('lainnya_luas')->nullable();
            $table->decimal('lainnya_harga_bangunan', 18, 2)->nullable();
            $table->string('lainnya_harga_peralatan')->nullable();
            $table->string('lainnya_harga_meubelair')->nullable();
            $table->string('lainnya_harga_peralatan_lab')->nullable();
            // Kerugian
            $table->integer('biaya_tenaga_kerja_hok')->nullable();
            $table->decimal('biaya_tenaga_kerja_upah', 18, 2)->nullable();
            $table->integer('biaya_alat_berat_hari')->nullable();
            $table->decimal('biaya_alat_berat_harga', 18, 2)->nullable();
            $table->integer('jumlah_penerima')->nullable();
            $table->decimal('bantuan_per_orang', 18, 2)->nullable();
            $table->decimal('biaya_pelayanan_kesehatan', 18, 2)->nullable();
            $table->decimal('biaya_pelayanan_pendidikan', 18, 2)->nullable();
            $table->decimal('biaya_pendampingan_psikososial', 18, 2)->nullable();
            $table->decimal('biaya_pelatihan_darurat', 18, 2)->nullable();
            // Total
            $table->decimal('total_kerusakan', 20, 2)->nullable()->default(0);
            $table->decimal('total_kerugian', 20, 2)->nullable()->default(0);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('format4_form4s');
    }
};
