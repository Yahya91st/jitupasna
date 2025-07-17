<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('format1_form4s', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('bencana_id');
            
            // Basic Information
            $table->string('nama_kampung');
            $table->string('nama_distrik');
            
            // Housing Damage Data
            $table->integer('rumah_hancur_total_permanen')->nullable()->default(0);
            $table->integer('rumah_hancur_total_non_permanen')->nullable()->default(0);
            $table->integer('rumah_rusak_berat_permanen')->nullable()->default(0);
            $table->integer('rumah_rusak_berat_non_permanen')->nullable()->default(0);
            $table->integer('rumah_rusak_sedang_permanen')->nullable()->default(0);
            $table->integer('rumah_rusak_sedang_non_permanen')->nullable()->default(0);
            $table->integer('rumah_rusak_ringan_permanen')->nullable()->default(0);
            $table->integer('rumah_rusak_ringan_non_permanen')->nullable()->default(0);
            
            // Unit Prices per category
            // 1a) Hancur Total
            $table->decimal('harga_satuan_hancur_total_permanen', 15, 2)->nullable()->default(0);
            $table->decimal('harga_satuan_hancur_total_non_permanen', 15, 2)->nullable()->default(0);
            
            // 1b) Rusak Berat
            $table->decimal('harga_satuan_rusak_berat_permanen', 15, 2)->nullable()->default(0);
            $table->decimal('harga_satuan_rusak_berat_non_permanen', 15, 2)->nullable()->default(0);
            
            // 1c) Rusak Sedang
            $table->decimal('harga_satuan_rusak_sedang_permanen', 15, 2)->nullable()->default(0);
            $table->decimal('harga_satuan_rusak_sedang_non_permanen', 15, 2)->nullable()->default(0);
            
            // 1d) Rusak Ringan
            $table->decimal('harga_satuan_rusak_ringan_permanen', 15, 2)->nullable()->default(0);
            $table->decimal('harga_satuan_rusak_ringan_non_permanen', 15, 2)->nullable()->default(0);
            
            // Infrastructure Damage - Roads
            $table->decimal('jalan_rusak_berat', 10, 2)->nullable()->default(0);
            $table->decimal('jalan_rusak_sedang', 10, 2)->nullable()->default(0);
            $table->decimal('jalan_rusak_ringan', 10, 2)->nullable()->default(0);
            $table->decimal('harga_satuan_jalan', 15, 2)->nullable()->default(0);
            
            // Infrastructure Damage - Drainage
            $table->decimal('saluran_rusak_berat', 10, 2)->nullable()->default(0);
            $table->decimal('saluran_rusak_sedang', 10, 2)->nullable()->default(0);
            $table->decimal('saluran_rusak_ringan', 10, 2)->nullable()->default(0);
            $table->decimal('harga_satuan_saluran', 15, 2)->nullable()->default(0);
            
            // Infrastructure Damage - Community Halls
            $table->integer('balai_rusak_berat')->nullable()->default(0);
            $table->integer('balai_rusak_sedang')->nullable()->default(0);
            $table->integer('balai_rusak_ringan')->nullable()->default(0);
            $table->decimal('harga_satuan_balai', 15, 2)->nullable()->default(0);
            
            // Loss Estimation - Cleanup Costs
            $table->integer('tenaga_kerja_hok')->nullable()->default(0);
            $table->decimal('upah_harian', 12, 2)->nullable()->default(0);
            $table->integer('alat_berat_hari')->nullable()->default(0);
            $table->decimal('biaya_per_hari', 12, 2)->nullable()->default(0);
            
            // Loss Estimation - Housing Rental
            $table->integer('jumlah_rumah_disewa')->nullable()->default(0);
            $table->decimal('harga_sewa_per_bulan', 12, 2)->nullable()->default(0);
            $table->integer('durasi_sewa_bulan')->nullable()->default(0);
            
            // Loss Estimation - Temporary Shelter
            $table->integer('jumlah_tenda')->nullable()->default(0);
            $table->decimal('harga_tenda', 12, 2)->nullable()->default(0);
            $table->integer('jumlah_barak')->nullable()->default(0);
            $table->decimal('harga_barak', 12, 2)->nullable()->default(0);
            $table->integer('jumlah_rumah_sementara')->nullable()->default(0);
            $table->decimal('harga_rumah_sementara', 12, 2)->nullable()->default(0);
            
            $table->decimal('total_kerusakan', 20, 2)->nullable()->default(0);
            $table->decimal('total_kerugian', 20, 2)->nullable()->default(0);

            $table->timestamps();
            
            // Foreign key constraints will be added in the final migration: 9999_12_31_235959_add_all_foreign_key_constraints.php
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('format1_form4s');
    }
};
