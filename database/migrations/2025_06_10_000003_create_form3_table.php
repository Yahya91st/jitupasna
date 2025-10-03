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
        Schema::create('form3', function (Blueprint $table) {
            $table->id();
            
            // Basic Information
            $table->string('wilayah_bencana')->nullable();
            $table->string('tim_fgd')->nullable();
            $table->string('fasilitator')->nullable();
            $table->string('notulis')->nullable();
            $table->date('tanggal_fgd')->nullable();
            $table->time('waktu_mulai')->nullable();
            $table->time('waktu_selesai')->nullable();
            $table->string('lokasi_fgd')->nullable();
            
            // Data Dasar Sebelum Bencana - Penduduk
            $table->integer('penduduk_laki_laki')->default(0);
            $table->integer('penduduk_perempuan')->default(0);
            $table->integer('penduduk_rumah_tangga')->default(0);
            
            // Data Dasar Sebelum Bencana - Sarana Kesehatan
            $table->integer('rumah_sakit')->default(0);
            $table->integer('puskesmas')->default(0);
            $table->integer('puskesmas_pembantu')->default(0);
            $table->integer('polindes')->default(0);
            $table->integer('posyandu')->default(0);
            
            // Data Dasar Sebelum Bencana - Tenaga Kesehatan
            $table->integer('dokter')->default(0);
            $table->integer('paramedis')->default(0);
            $table->integer('bidan')->default(0);
            $table->integer('kader_kesehatan')->default(0);
            
            // Data Dasar Sebelum Bencana - Balita
            $table->integer('balita')->default(0);
            $table->integer('balita_gizi_buruk')->default(0);
            $table->integer('balita_gizi_kurang')->default(0);
            $table->integer('ditimbang_posyandu')->default(0);
            
            // FGD Questions
            $table->text('program_kesehatan_masal')->nullable();
            $table->text('permasalahan_kesehatan')->nullable();
            $table->text('kegiatan_permasalahan_kesehatan')->nullable();
            $table->text('program_makanan_tambahan')->nullable();
            $table->integer('jumlah_balita_terdampak')->default(0);
            $table->text('dampak_balita')->nullable();
            $table->text('kegiatan_balita')->nullable();
            $table->integer('jumlah_ibu_hamil_terdampak')->default(0);
            $table->text('dampak_ibu_hamil')->nullable();
            $table->text('kegiatan_ibu_hamil')->nullable();
            $table->integer('jumlah_lansia_terdampak')->default(0);
            $table->text('dampak_lansia')->nullable();
            $table->text('kegiatan_lansia')->nullable();
            $table->text('dampak_kesehatan_menengah')->nullable();
            $table->text('kegiatan_dampak_kesehatan')->nullable();
            $table->text('rencana_kontingensi_kesehatan')->nullable();
            
            // Relation to Bencana
            $table->foreignId('bencana_id')->constrained('bencana')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('form3');
    }
};
