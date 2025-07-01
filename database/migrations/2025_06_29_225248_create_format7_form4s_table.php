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
        Schema::create('format7_form4s', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('bencana_id');
            $table->string('nama_kampung');
            $table->string('nama_distrik');
            
            // Jalan
            $table->string('jalan_ruas')->nullable();
            $table->string('jalan_jenis')->nullable();
            $table->string('jalan_tipe')->nullable();
            $table->decimal('jalan_rusak_berat', 10, 2)->nullable()->default(0);
            $table->decimal('jalan_rusak_sedang', 10, 2)->nullable()->default(0);
            $table->decimal('jalan_rusak_ringan', 10, 2)->nullable()->default(0);
            $table->decimal('jalan_harga_satuan', 15, 2)->nullable()->default(0);
            $table->decimal('jalan_biaya_perbaikan', 15, 2)->nullable()->default(0);
            
            // Jembatan
            $table->string('jembatan_nama')->nullable();
            $table->string('jembatan_jenis')->nullable();
            $table->string('jembatan_tipe')->nullable();
            $table->decimal('jembatan_rusak_berat', 10, 2)->nullable()->default(0);
            $table->decimal('jembatan_rusak_sedang', 10, 2)->nullable()->default(0);
            $table->decimal('jembatan_rusak_ringan', 10, 2)->nullable()->default(0);
            $table->decimal('jembatan_harga_satuan', 15, 2)->nullable()->default(0);
            $table->decimal('jembatan_biaya_perbaikan', 15, 2)->nullable()->default(0);
            
            // Kerusakan Kendaraan
            $table->integer('sedan_minibus_jumlah')->nullable()->default(0);
            $table->integer('sedan_minibus_unit')->nullable()->default(0);
            $table->integer('bus_truk_jumlah')->nullable()->default(0);
            $table->integer('bus_truk_unit')->nullable()->default(0);
            $table->integer('kendaraan_berat_jumlah')->nullable()->default(0);
            $table->integer('kendaraan_berat_unit')->nullable()->default(0);
            $table->integer('kapal_laut_jumlah')->nullable()->default(0);
            $table->integer('kapal_laut_unit')->nullable()->default(0);
            $table->integer('bus_air_jumlah')->nullable()->default(0);
            $table->integer('bus_air_unit')->nullable()->default(0);
            $table->integer('speed_boat_jumlah')->nullable()->default(0);
            $table->integer('speed_boat_unit')->nullable()->default(0);
            $table->integer('perahu_klotok_jumlah')->nullable()->default(0);
            $table->integer('perahu_klotok_unit')->nullable()->default(0);
            
            // Prasarana Transportasi
            $table->integer('terminal_jumlah')->nullable()->default(0);
            $table->integer('terminal_rusak_berat')->nullable()->default(0);
            $table->integer('terminal_rusak_sedang')->nullable()->default(0);
            $table->integer('terminal_rusak_ringan')->nullable()->default(0);
            $table->decimal('terminal_biaya_perbaikan', 15, 2)->nullable()->default(0);
            $table->integer('dermaga_jumlah')->nullable()->default(0);
            $table->integer('dermaga_rusak_berat')->nullable()->default(0);
            $table->integer('dermaga_rusak_sedang')->nullable()->default(0);
            $table->integer('dermaga_rusak_ringan')->nullable()->default(0);
            $table->decimal('dermaga_biaya_perbaikan', 15, 2)->nullable()->default(0);
            $table->integer('bandara_jumlah')->nullable()->default(0);
            $table->integer('bandara_rusak_berat')->nullable()->default(0);
            $table->integer('bandara_rusak_sedang')->nullable()->default(0);
            $table->integer('bandara_rusak_ringan')->nullable()->default(0);
            $table->decimal('bandara_biaya_perbaikan', 15, 2)->nullable()->default(0);
            
            // Kehilangan Pendapatan
            $table->decimal('pendapatan_darat_per_hari', 15, 2)->nullable()->default(0);
            $table->integer('jumlah_angkutan_darat_terdampak')->nullable()->default(0);
            $table->decimal('pendapatan_laut_per_hari', 15, 2)->nullable()->default(0);
            $table->integer('jumlah_angkutan_laut_terdampak')->nullable()->default(0);
            $table->decimal('pendapatan_udara_per_hari', 15, 2)->nullable()->default(0);
            $table->integer('jumlah_angkutan_udara_terdampak')->nullable()->default(0);
            $table->decimal('pendapatan_terminal_per_hari', 15, 2)->nullable()->default(0);
            $table->decimal('pendapatan_dermaga_per_hari', 15, 2)->nullable()->default(0);
            $table->decimal('pendapatan_bandara_per_hari', 15, 2)->nullable()->default(0);
            
            // Kenaikan Biaya Operasional
            $table->decimal('biaya_operasional_sebelum', 15, 2)->nullable()->default(0);
            $table->decimal('biaya_operasional_setelah', 15, 2)->nullable()->default(0);
            $table->integer('jumlah_kendaraan_biaya_operasional')->nullable()->default(0);
            
            // Infrastruktur Darurat
            $table->integer('infrastruktur_darurat_jumlah')->nullable()->default(0);
            $table->decimal('infrastruktur_darurat_biaya', 15, 2)->nullable()->default(0);
            
            $table->timestamps();
            $table->softDeletes();
            
            // Indexes for better performance
            $table->index('bencana_id');
            $table->index(['nama_kampung', 'nama_distrik']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('format7_form4s');
    }
};
