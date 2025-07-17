<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('format9_form4s', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('bencana_id')->index();
            $table->string('nama_kampung')->nullable();
            $table->string('nama_distrik')->nullable();
            // Kerusakan Sarana dan Prasarana (4 baris)
            $table->string('kerusakan_1_nama')->nullable();
            $table->string('kerusakan_1_satuan')->nullable();
            $table->integer('kerusakan_1_jumlah_unit')->nullable();
            $table->decimal('kerusakan_1_harga_satuan', 20, 2)->nullable();
            $table->string('kerusakan_2_nama')->nullable();
            $table->string('kerusakan_2_satuan')->nullable();
            $table->integer('kerusakan_2_jumlah_unit')->nullable();
            $table->decimal('kerusakan_2_harga_satuan', 20, 2)->nullable();
            $table->string('kerusakan_3_nama')->nullable();
            $table->string('kerusakan_3_satuan')->nullable();
            $table->integer('kerusakan_3_jumlah_unit')->nullable();
            $table->decimal('kerusakan_3_harga_satuan', 20, 2)->nullable();
            $table->string('kerusakan_4_nama')->nullable();
            $table->string('kerusakan_4_satuan')->nullable();
            $table->integer('kerusakan_4_jumlah_unit')->nullable();
            $table->decimal('kerusakan_4_harga_satuan', 20, 2)->nullable();
            // Perkiraan Jangka Waktu Pemulihan
            $table->integer('jangka_waktu_pemulihan_a')->nullable();
            $table->string('jangka_waktu_satuan')->nullable();
            $table->integer('jangka_waktu_unit')->nullable();
            $table->decimal('jangka_waktu_harga_satuan', 20, 2)->nullable();
            // Perkiraan Kehilangan Pendapatan
            $table->string('permintaan_sebelum_satuan')->nullable();
            $table->integer('permintaan_sebelum_unit')->nullable();
            $table->decimal('permintaan_sebelum_harga_satuan', 20, 2)->nullable();
            $table->string('permintaan_pasca_satuan')->nullable();
            $table->integer('permintaan_pasca_unit')->nullable();
            $table->decimal('permintaan_pasca_harga_satuan', 20, 2)->nullable();
            $table->string('tarif_satuan')->nullable();
            $table->integer('tarif_unit')->nullable();
            $table->decimal('tarif_harga_satuan', 20, 2)->nullable();
            $table->string('penurunan_pendapatan_satuan')->nullable();
            $table->integer('penurunan_pendapatan_unit')->nullable();
            $table->decimal('penurunan_pendapatan_harga_satuan', 20, 2)->nullable();
            // Perkiraan Kenaikan Biaya Operasional (3 baris)
            $table->string('biaya_operasional_sebelum_satuan')->nullable();
            $table->integer('biaya_operasional_sebelum_unit')->nullable();
            $table->decimal('biaya_operasional_sebelum_harga_satuan', 20, 2)->nullable();
            $table->string('biaya_operasional_pasca_satuan')->nullable();
            $table->integer('biaya_operasional_pasca_unit')->nullable();
            $table->decimal('biaya_operasional_pasca_harga_satuan', 20, 2)->nullable();
            $table->string('kenaikan_biaya_operasional_satuan')->nullable();
            $table->integer('kenaikan_biaya_operasional_unit')->nullable();
            $table->decimal('kenaikan_biaya_operasional_harga_satuan', 20, 2)->nullable();
            // Total
            $table->decimal('total_kerusakan', 20, 2)->nullable()->default(0);
            $table->decimal('total_kerugian', 20, 2)->nullable()->default(0);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('format9_form4s');
    }
};
