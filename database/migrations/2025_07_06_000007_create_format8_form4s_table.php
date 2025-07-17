<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('format8_form4s', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('bencana_id')->index();
            $table->string('nama_kampung')->nullable();
            $table->string('nama_distrik')->nullable();
            // Sistem Transmisi dan Distribusi
            $table->integer('kabel_unit')->nullable()->default(0);
            $table->decimal('kabel_harga_satuan', 15, 2)->nullable()->default(0);
            $table->decimal('kabel_jumlah', 20, 2)->nullable()->default(0);
            $table->integer('tiang_unit')->nullable()->default(0);
            $table->decimal('tiang_harga_satuan', 15, 2)->nullable()->default(0);
            $table->decimal('tiang_jumlah', 20, 2)->nullable()->default(0);
            $table->integer('trafo_unit')->nullable()->default(0);
            $table->decimal('trafo_harga_satuan', 15, 2)->nullable()->default(0);
            $table->decimal('trafo_jumlah', 20, 2)->nullable()->default(0);
            // Sistem Pembangkitan
            $table->integer('plta_unit')->nullable()->default(0);
            $table->decimal('plta_harga_satuan', 15, 2)->nullable()->default(0);
            $table->decimal('plta_jumlah', 20, 2)->nullable()->default(0);
            $table->integer('pltu_unit')->nullable()->default(0);
            $table->decimal('pltu_harga_satuan', 15, 2)->nullable()->default(0);
            $table->decimal('pltu_jumlah', 20, 2)->nullable()->default(0);
            $table->integer('pltd_unit')->nullable()->default(0);
            $table->decimal('pltd_harga_satuan', 15, 2)->nullable()->default(0);
            $table->decimal('pltd_jumlah', 20, 2)->nullable()->default(0);
            $table->integer('pembangkit_lain_unit')->nullable()->default(0);
            $table->decimal('pembangkit_lain_harga_satuan', 15, 2)->nullable()->default(0);
            $table->decimal('pembangkit_lain_jumlah', 20, 2)->nullable()->default(0);
            $table->string('pembangkit_lain_keterangan')->nullable();
            // Perkiraan Jangka Waktu Pemulihan
            $table->integer('jangka_waktu_pemulihan_bulan')->nullable()->default(0);
            // Pembangkit Listrik Darurat
            $table->integer('genset_unit')->nullable()->default(0);
            $table->decimal('genset_biaya_pengadaan', 20, 2)->nullable()->default(0);
            $table->decimal('biaya_genset_total', 20, 2)->nullable()->default(0);
            // Perkiraan Kehilangan/Penurunan Pendapatan
            $table->decimal('permintaan_listrik_sebelum_kwh', 20, 2)->nullable()->default(0);
            $table->decimal('permintaan_listrik_pasca_kwh', 20, 2)->nullable()->default(0);
            $table->decimal('tarif_listrik_per_kwh', 20, 2)->nullable()->default(0);
            $table->decimal('penurunan_pendapatan', 20, 2)->nullable()->default(0);
            // Perkiraan Kenaikan Biaya Operasional
            $table->decimal('biaya_operasional_sebelum', 20, 2)->nullable()->default(0);
            $table->decimal('biaya_operasional_pasca', 20, 2)->nullable()->default(0);
            $table->decimal('kenaikan_biaya_operasional', 20, 2)->nullable()->default(0);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('format8_form4s');
    }
};
