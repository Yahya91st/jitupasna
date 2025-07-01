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
        Schema::create('transportation_reports', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('bencana_id');
            // $table->foreign('bencana_id')->references('id')->on('bencana')->onDelete('cascade');
            
            // Report type (to differentiate between different sections of the form)
            $table->enum('report_type', [
                'jalan', // Roads
                'jembatan', // Bridges
                'kendaraan', // Vehicles
                'prasarana', // Infrastructure
                'pendapatan', // Revenue loss
                'operasional', // Operational costs
                'infrastruktur_darurat' // Emergency infrastructure
            ]);
            
            // Common fields
            $table->decimal('rusak_berat', 15, 2)->nullable();
            $table->decimal('rusak_sedang', 15, 2)->nullable();
            $table->decimal('rusak_ringan', 15, 2)->nullable();
            $table->decimal('harga_satuan', 15, 2)->nullable();
            $table->decimal('biaya_total', 15, 2)->nullable();
            
            // Jalan (Road) specific fields
            $table->string('ruas_jalan')->nullable();
            $table->enum('status_jalan', ['Nasional', 'Kabupaten', 'Kota', 'Desa'])->nullable();
            $table->enum('jenis_jalan', ['Aspal', 'Batu', 'Tanah'])->nullable();
            
            // Jembatan (Bridge) specific fields
            $table->string('nama_jembatan')->nullable();
            $table->enum('status_jembatan', ['Nasional', 'Kabupaten', 'Kota', 'Desa'])->nullable();
            $table->enum('jenis_jembatan', ['Beton', 'Baja', 'Kayu'])->nullable();
            
            // Kendaraan (Vehicle) specific fields
            $table->string('jenis_kendaraan')->nullable();
            $table->enum('moda', ['Darat', 'Laut', 'Udara'])->nullable();
            
            // Prasarana (Infrastructure) specific fields
            $table->string('jenis_prasarana')->nullable();
            $table->string('tipe_prasarana')->nullable();
            $table->decimal('luas_prasarana', 15, 2)->nullable();
            
            // Pendapatan (Revenue) specific fields
            $table->decimal('pendapatan_per_hari', 15, 2)->nullable();
            $table->integer('jumlah_terdampak')->nullable();
            $table->integer('jumlah_hari')->nullable();
            
            // Operasional (Operational costs) specific fields
            $table->decimal('biaya_sebelum', 15, 2)->nullable();
            $table->decimal('biaya_sesudah', 15, 2)->nullable();
            $table->integer('jumlah_kendaraan')->nullable();
            $table->decimal('jarak_tempuh', 15, 2)->nullable();
            $table->integer('durasi')->nullable();
            
            // Infrastruktur Darurat (Emergency infrastructure) specific fields
            $table->string('jenis_infrastruktur_darurat')->nullable();
            $table->integer('jumlah_unit')->nullable();
            $table->decimal('biaya_per_unit', 15, 2)->nullable();
            
            // Additional metadata fields
            $table->string('catatan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transportation_reports');
    }
};
