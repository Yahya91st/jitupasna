<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('format16_form4s', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('bencana_id')->index();
            $table->string('kabupaten')->nullable();
            $table->string('nama_kampung')->nullable();
            $table->string('nama_distrik')->nullable();
            // Kantor Pemkab
            $table->integer('kantor_pemkab_berat')->nullable()->default(0);
            $table->integer('kantor_pemkab_sedang')->nullable()->default(0);
            $table->integer('kantor_pemkab_ringan')->nullable()->default(0);
            $table->decimal('kantor_pemkab_rb_harga', 20, 2)->nullable()->default(0);
            $table->decimal('kantor_pemkab_rs_harga', 20, 2)->nullable()->default(0);
            $table->decimal('kantor_pemkab_rr_harga', 20, 2)->nullable()->default(0);
            // Kantor Kecamatan
            $table->integer('kantor_kecamatan_berat')->nullable()->default(0);
            $table->integer('kantor_kecamatan_sedang')->nullable()->default(0);
            $table->integer('kantor_kecamatan_ringan')->nullable()->default(0);
            $table->decimal('kantor_kecamatan_rb_harga', 20, 2)->nullable()->default(0);
            $table->decimal('kantor_kecamatan_rs_harga', 20, 2)->nullable()->default(0);
            $table->decimal('kantor_kecamatan_rr_harga', 20, 2)->nullable()->default(0);
            // Kantor Dinas
            $table->integer('kantor_dinas_berat')->nullable()->default(0);
            $table->integer('kantor_dinas_sedang')->nullable()->default(0);
            $table->integer('kantor_dinas_ringan')->nullable()->default(0);
            $table->decimal('kantor_dinas_rb_harga', 20, 2)->nullable()->default(0);
            $table->decimal('kantor_dinas_rs_harga', 20, 2)->nullable()->default(0);
            $table->decimal('kantor_dinas_rr_harga', 20, 2)->nullable()->default(0);
            // Kantor Instansi Vertikal
            $table->integer('kantor_vertikal_berat')->nullable()->default(0);
            $table->integer('kantor_vertikal_sedang')->nullable()->default(0);
            $table->integer('kantor_vertikal_ringan')->nullable()->default(0);
            $table->decimal('kantor_vertikal_rb_harga', 20, 2)->nullable()->default(0);
            $table->decimal('kantor_vertikal_rs_harga', 20, 2)->nullable()->default(0);
            $table->decimal('kantor_vertikal_rr_harga', 20, 2)->nullable()->default(0);
            // Mebelair dan Peralatan Kantor
            $table->integer('mebelair_berat')->nullable()->default(0);
            $table->integer('mebelair_sedang')->nullable()->default(0);
            $table->integer('mebelair_ringan')->nullable()->default(0);
            $table->decimal('mebelair_rb_harga', 20, 2)->nullable()->default(0);
            $table->decimal('mebelair_rs_harga', 20, 2)->nullable()->default(0);
            $table->decimal('mebelair_rr_harga', 20, 2)->nullable()->default(0);
            // Biaya Pembersihan Puing
            $table->integer('biaya_tenaga_kerja_hok')->nullable()->default(0);
            $table->decimal('upah_harian', 20, 2)->nullable()->default(0);
            $table->integer('biaya_alat_berat_hari')->nullable()->default(0);
            $table->decimal('biaya_alat_berat_tarif', 20, 2)->nullable()->default(0);
            // Biaya Sewa Kantor Sementara
            $table->integer('sewa_kantor_jumlah_unit')->nullable()->default(0);
            $table->decimal('sewa_kantor_biaya_per_unit', 20, 2)->nullable()->default(0);
            // Biaya Restorasi Arsip
            $table->integer('restorasi_arsip_jumlah')->nullable()->default(0);
            $table->decimal('restorasi_arsip_harga_satuan', 20, 2)->nullable()->default(0);
            // Kehilangan Pendapatan Retribusi
            $table->text('dasar_perhitungan_retribusi')->nullable();
            $table->decimal('total_kerusakan', 20, 2)->nullable()->default(0);
            $table->decimal('total_kerugian', 20, 2)->nullable()->default(0);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('format16_form4s');
    }
};
