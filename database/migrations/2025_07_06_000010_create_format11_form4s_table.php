<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('format11_form4s', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('bencana_id')->index();
            $table->string('nama_kampung')->nullable();
            $table->string('nama_distrik')->nullable();
            // Kematian Hewan Ternak (4 baris)
            $table->string('kematian_1_jenis')->nullable();
            $table->integer('kematian_1_unit')->nullable();
            $table->decimal('kematian_1_harga_satuan', 20, 2)->nullable();
            $table->string('kematian_2_jenis')->nullable();
            $table->integer('kematian_2_unit')->nullable();
            $table->decimal('kematian_2_harga_satuan', 20, 2)->nullable();
            $table->string('kematian_3_jenis')->nullable();
            $table->integer('kematian_3_unit')->nullable();
            $table->decimal('kematian_3_harga_satuan', 20, 2)->nullable();
            $table->string('kematian_4_jenis')->nullable();
            $table->integer('kematian_4_unit')->nullable();
            $table->decimal('kematian_4_harga_satuan', 20, 2)->nullable();
            // Kerusakan Kandang (3 baris)
            $table->string('kandang_1_jenis')->nullable();
            $table->integer('kandang_1_unit')->nullable();
            $table->decimal('kandang_1_harga_satuan', 20, 2)->nullable();
            $table->string('kandang_2_jenis')->nullable();
            $table->integer('kandang_2_unit')->nullable();
            $table->decimal('kandang_2_harga_satuan', 20, 2)->nullable();
            $table->string('kandang_3_jenis')->nullable();
            $table->integer('kandang_3_unit')->nullable();
            $table->decimal('kandang_3_harga_satuan', 20, 2)->nullable();
            // Kerusakan Peralatan Kandang (3 baris)
            $table->string('peralatan_1_jenis')->nullable();
            $table->integer('peralatan_1_unit')->nullable();
            $table->decimal('peralatan_1_harga_satuan', 20, 2)->nullable();
            $table->string('peralatan_2_jenis')->nullable();
            $table->integer('peralatan_2_unit')->nullable();
            $table->decimal('peralatan_2_harga_satuan', 20, 2)->nullable();
            $table->string('peralatan_3_jenis')->nullable();
            $table->integer('peralatan_3_unit')->nullable();
            $table->decimal('peralatan_3_harga_satuan', 20, 2)->nullable();
            // Produksi yang Hilang Total (3 baris)
            $table->string('hilang_1_jenis')->nullable();
            $table->integer('hilang_1_unit')->nullable();
            $table->decimal('hilang_1_harga_satuan', 20, 2)->nullable();
            $table->string('hilang_2_jenis')->nullable();
            $table->integer('hilang_2_unit')->nullable();
            $table->decimal('hilang_2_harga_satuan', 20, 2)->nullable();
            $table->string('hilang_3_jenis')->nullable();
            $table->integer('hilang_3_unit')->nullable();
            $table->decimal('hilang_3_harga_satuan', 20, 2)->nullable();
            // Penurunan Produktifitas (3 baris)
            $table->string('produktifitas_1_jenis')->nullable();
            $table->integer('produktifitas_1_unit')->nullable();
            $table->decimal('produktifitas_1_harga_satuan', 20, 2)->nullable();
            $table->string('produktifitas_2_jenis')->nullable();
            $table->integer('produktifitas_2_unit')->nullable();
            $table->decimal('produktifitas_2_harga_satuan', 20, 2)->nullable();
            $table->string('produktifitas_3_jenis')->nullable();
            $table->integer('produktifitas_3_unit')->nullable();
            $table->decimal('produktifitas_3_harga_satuan', 20, 2)->nullable();
            // Kenaikan Ongkos Produksi (3 baris)
            $table->string('ongkos_1_jenis')->nullable();
            $table->integer('ongkos_1_unit')->nullable();
            $table->decimal('ongkos_1_harga_satuan', 20, 2)->nullable();
            $table->string('ongkos_2_jenis')->nullable();
            $table->integer('ongkos_2_unit')->nullable();
            $table->decimal('ongkos_2_harga_satuan', 20, 2)->nullable();
            $table->string('ongkos_3_jenis')->nullable();
            $table->integer('ongkos_3_unit')->nullable();
            $table->decimal('ongkos_3_harga_satuan', 20, 2)->nullable();
            // Total
            $table->decimal('total_kerusakan', 20, 2)->nullable()->default(0);
            $table->decimal('total_kerugian', 20, 2)->nullable()->default(0);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('format11_form4s');
    }
};
