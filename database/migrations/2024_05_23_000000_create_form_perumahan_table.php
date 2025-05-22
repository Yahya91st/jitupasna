<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('form_perumahan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('bencana_id')->nullable()->constrained('bencana')->onDelete('cascade');
            $table->string('nama_kampung');
            $table->string('nama_distrik');
            
            // Rumah Permanen
            $table->integer('rumah_hancur_total_permanen')->nullable();
            $table->integer('rumah_rusak_berat_permanen')->nullable();
            $table->integer('rumah_rusak_sedang_permanen')->nullable();
            $table->integer('rumah_rusak_ringan_permanen')->nullable();
            $table->decimal('harga_satuan_permanen', 15, 2)->nullable();
            
            // Rumah Non-Permanen
            $table->integer('rumah_hancur_total_non_permanen')->nullable();
            $table->integer('rumah_rusak_berat_non_permanen')->nullable();
            $table->integer('rumah_rusak_sedang_non_permanen')->nullable();
            $table->integer('rumah_rusak_ringan_non_permanen')->nullable();
            $table->decimal('harga_satuan_non_permanen', 15, 2)->nullable();
            
            // Jalan Lingkungan
            $table->decimal('jalan_rusak_berat', 15, 2)->nullable();
            $table->decimal('jalan_rusak_sedang', 15, 2)->nullable();
            $table->decimal('jalan_rusak_ringan', 15, 2)->nullable();
            $table->decimal('harga_satuan_jalan', 15, 2)->nullable();
            
            // Saluran Air/Gorong-gorong
            $table->decimal('saluran_rusak_berat', 15, 2)->nullable();
            $table->decimal('saluran_rusak_sedang', 15, 2)->nullable();
            $table->decimal('saluran_rusak_ringan', 15, 2)->nullable();
            $table->decimal('harga_satuan_saluran', 15, 2)->nullable();
            
            // Balai Pertemuan
            $table->integer('balai_rusak_berat')->nullable();
            $table->integer('balai_rusak_sedang')->nullable();
            $table->decimal('harga_satuan_balai', 15, 2)->nullable();
            
            // Pembersihan Puing
            $table->integer('tenaga_kerja_hok')->nullable();
            $table->decimal('upah_harian', 15, 2)->nullable();
            $table->integer('alat_berat_hari')->nullable();
            $table->decimal('biaya_per_hari', 15, 2)->nullable();
            
            // Rumah Disewakan
            $table->decimal('harga_sewa_per_bulan', 15, 2)->nullable();
            
            // Hunian Sementara
            $table->integer('jumlah_tenda')->nullable();
            $table->decimal('harga_tenda', 15, 2)->nullable();
            $table->integer('jumlah_barak')->nullable();
            $table->decimal('harga_barak', 15, 2)->nullable();
            $table->integer('jumlah_rumah_sementara')->nullable();
            $table->decimal('harga_rumah_sementara', 15, 2)->nullable();
            
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('form_perumahan');
    }
};