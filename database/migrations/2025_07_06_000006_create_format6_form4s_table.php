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
            $table->integer('struktur_air_unit')->nullable();
            $table->decimal('struktur_air_harga', 12, 2)->nullable();
            $table->decimal('struktur_air_total', 18, 2)->nullable();
            $table->integer('instalasi_pemurnian_unit')->nullable();
            $table->decimal('instalasi_pemurnian_harga', 12, 2)->nullable();
            $table->decimal('instalasi_pemurnian_total', 18, 2)->nullable();
            $table->integer('perpipaan_unit')->nullable();
            $table->decimal('perpipaan_harga', 12, 2)->nullable();
            $table->decimal('perpipaan_total', 18, 2)->nullable();
            $table->integer('penyimpanan_unit')->nullable();
            $table->decimal('penyimpanan_harga', 12, 2)->nullable();
            $table->decimal('penyimpanan_total', 18, 2)->nullable();
            $table->integer('sumur_unit')->nullable();
            $table->decimal('sumur_harga', 12, 2)->nullable();
            $table->decimal('sumur_total', 18, 2)->nullable();
            $table->integer('mck_unit')->nullable();
            $table->decimal('mck_harga', 12, 2)->nullable();
            $table->decimal('mck_total', 18, 2)->nullable();
            // Sistem Sanitasi
            $table->integer('sanitasi_unit')->nullable();
            $table->decimal('sanitasi_harga', 12, 2)->nullable();
            $table->decimal('sanitasi_total', 18, 2)->nullable();
            $table->integer('drainase_unit')->nullable();
            $table->decimal('drainase_harga', 12, 2)->nullable();
            $table->decimal('drainase_total', 18, 2)->nullable();
            $table->integer('limbah_padat_unit')->nullable()->default(0);
            $table->decimal('limbah_padat_harga', 15, 2)->nullable()->default(0);
            $table->decimal('limbah_padat_total', 20, 2)->nullable()->default(0);
            $table->integer('wc_umum_unit')->nullable()->default(0);
            $table->decimal('wc_umum_harga', 15, 2)->nullable()->default(0);
            $table->decimal('wc_umum_total', 20, 2)->nullable()->default(0);
            // Perkiraan Kerugian
            $table->decimal('kehilangan_pendapatan_pdam', 20, 2)->nullable()->default(0);
            $table->decimal('biaya_pemurnian_air', 20, 2)->nullable()->default(0);
            $table->decimal('biaya_distribusi_air', 20, 2)->nullable()->default(0);
            $table->decimal('biaya_pembersihan_sumur', 20, 2)->nullable()->default(0);
            $table->decimal('biaya_lain_air', 20, 2)->nullable()->default(0);
            $table->decimal('biaya_sanitasi_lain', 20, 2)->nullable()->default(0);
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
