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
        Schema::create('government_damages', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('bencana_id');
            $table->string('jenis_fasilitas');
            $table->integer('jumlah_rb')->nullable();
            $table->integer('jumlah_rs')->nullable();
            $table->integer('jumlah_rr')->nullable();
            $table->decimal('harga_rb', 15, 2)->nullable();
            $table->decimal('harga_rs', 15, 2)->nullable();
            $table->decimal('harga_rr', 15, 2)->nullable();
            $table->timestamps();

            $table->foreign('bencana_id')->references('id')->on('bencana')->onDelete('cascade');
        });

        Schema::create('government_losses', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('bencana_id');
            
            // A. Pembersihan Puing
            $table->integer('tenaga_kerja_hok')->nullable();
            $table->decimal('upah_harian', 15, 2)->nullable();
            $table->integer('alat_berat_hari')->nullable();
            $table->decimal('biaya_per_hari_alat_berat', 15, 2)->nullable();

            // B. Sewa Kantor Sementara
            $table->integer('jumlah_unit')->nullable();
            $table->decimal('biaya_sewa_per_unit', 15, 2)->nullable();

            // C. Restorasi Arsip
            $table->integer('jumlah_arsip')->nullable();
            $table->decimal('harga_satuan', 15, 2)->nullable();

            // D. Kehilangan Pendapatan
            $table->text('dasar_perhitungan')->nullable();

            $table->timestamps();
            
            $table->foreign('bencana_id')->references('id')->on('bencana')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('government_damages');
        Schema::dropIfExists('government_losses');
    }
};
