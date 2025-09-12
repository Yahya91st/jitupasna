<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('format6_form4s', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('bencana_id')->index();
            $table->string('nama_kampung')->nullable();
            $table->string('nama_distrik')->nullable();
            // Sarana Air Minum
            $table->string('struktur_air_unit')->nullable();
            $table->integer('struktur_air_jumlah')->nullable();
            $table->decimal('struktur_air_harga_satuan', 12, 2)->nullable();
            $table->decimal('struktur_air_total', 18, 2)->nullable();
            $table->string('instalasi_pemurnian_unit')->nullable();
            $table->integer('instalasi_pemurnian_jumlah')->nullable();
            $table->decimal('instalasi_pemurnian_harga_satuan', 12, 2)->nullable();
            $table->decimal('instalasi_pemurnian_total', 18, 2)->nullable();
            $table->string('perpipaan_unit')->nullable();
            $table->integer('perpipaan_jumlah')->nullable();
            $table->decimal('perpipaan_harga_satuan', 12, 2)->nullable();
            $table->decimal('perpipaan_total', 18, 2)->nullable();
            $table->string('penyimpanan_unit')->nullable();
            $table->integer('penyimpanan_jumlah')->nullable();
            $table->decimal('penyimpanan_harga_satuan', 12, 2)->nullable();
            $table->decimal('penyimpanan_total', 18, 2)->nullable();
            $table->string('sumur_unit')->nullable();
            $table->integer('sumur_jumlah')->nullable();
            $table->decimal('sumur_harga_satuan', 12, 2)->nullable();
            $table->decimal('sumur_total', 18, 2)->nullable();
            $table->string('mck_unit')->nullable();
            $table->integer('mck_jumlah')->nullable();
            $table->decimal('mck_harga_satuan', 12, 2)->nullable();
            $table->decimal('mck_total', 18, 2)->nullable();
            // Sistem Sanitasi
            $table->string('sanitasi_unit')->nullable();
            $table->integer('sanitasi_jumlah')->nullable();
            $table->decimal('sanitasi_harga_satuan', 12, 2)->nullable();
            $table->decimal('sanitasi_total', 18, 2)->nullable();
            $table->string('drainase_unit')->nullable();
            $table->integer('drainase_jumlah')->nullable();
            $table->decimal('drainase_harga_satuan', 12, 2)->nullable();
            $table->decimal('drainase_total', 18, 2)->nullable();
            $table->string('limbah_padat_unit')->nullable();
            $table->integer('limbah_padat_jumlah')->nullable();
            $table->decimal('limbah_padat_harga_satuan', 15, 2)->nullable();
            $table->decimal('limbah_padat_total', 20, 2)->nullable();
            $table->string('wc_umum_unit')->nullable();
            $table->integer('wc_umum_jumlah')->nullable();
            $table->decimal('wc_umum_harga_satuan', 15, 2)->nullable();
            $table->decimal('wc_umum_total', 20, 2)->nullable();
            // Perkiraan Kerugian
            $table->decimal('kehilangan_pendapatan_pdam', 20, 2)->nullable()->default(0);
            $table->decimal('biaya_pemurnian', 20, 2)->nullable()->default(0);
            $table->text('dasar_perhitungan_biaya_pemurnian')->nullable();
            $table->decimal('biaya_distribusi', 20, 2)->nullable()->default(0);
            $table->text('dasar_perhitungan_biaya_distribusi')->nullable();
            $table->decimal('biaya_pembersihan', 20, 2)->nullable()->default(0);
            $table->text('dasar_perhitungan_biaya_pembersihan')->nullable();
            $table->decimal('biaya_lain', 20, 2)->nullable()->default(0);
            $table->text('dasar_perhitungan_biaya_lain')->nullable();
            $table->decimal('sanitasi_pendapatan', 20, 2)->nullable()->default(0);
            $table->decimal('biaya_pembersihan_jaringan', 20, 2)->nullable()->default(0);
            $table->text('dasar_perhitungan_biaya_pembersihan_jaringan')->nullable();
            $table->decimal('biaya_bahan_kimia', 20, 2)->nullable()->default(0);
            $table->text('dasar_perhitungan_biaya_bahan_kimia')->nullable();
            $table->decimal('total_kerusakan', 20, 2)->nullable()->default(0);
            $table->decimal('total_kerugian', 20, 2)->nullable()->default(0);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('format6_form4s');
    }
};
