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
        Schema::create('form6', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('bencana_id');
            
            // Pengumpulan data
            $table->string('enumerator')->nullable();
            $table->date('tgl_wawancara')->nullable();
            $table->string('paraf_enum')->nullable();
            
            // Perekaman data
            $table->string('data_entry')->nullable();
            $table->date('tgl_entry')->nullable();
            $table->string('paraf_entry')->nullable();
            
            // Informasi Umum Responden
            $table->boolean('responden_l')->default(false);
            $table->boolean('responden_p')->default(false);
            
            // Umur responden
            $table->boolean('umur_20')->default(false);
            $table->boolean('umur_21_30')->default(false);
            $table->boolean('umur_31_40')->default(false);
            $table->boolean('umur_41_50')->default(false);
            $table->boolean('umur_50plus')->default(false);
            
            $table->string('nama')->nullable();
            $table->string('desa')->nullable();
            $table->string('kecamatan')->nullable();
            $table->string('kabupaten')->nullable();
            
            // Pendidikan terakhir
            $table->boolean('pend_sd')->default(false);
            $table->boolean('pend_sltp')->default(false);
            $table->boolean('pend_slta')->default(false);
            $table->boolean('pend_pt')->default(false);
            
            // Kepala rumah tangga perempuan
            $table->boolean('krt_perempuan_ya')->default(false);
            $table->boolean('krt_perempuan_tidak')->default(false);
            
            // Jumlah anggota keluarga berdasarkan umur
            $table->integer('anggota_0_5')->default(0);
            $table->integer('anggota_6_17')->default(0);
            $table->integer('anggota_18_59')->default(0);
            $table->integer('anggota_60plus')->default(0);
            
            // Status rumah
            $table->boolean('rumah_milik_sendiri')->default(false);
            $table->boolean('rumah_sewa')->default(false);
            $table->boolean('rumah_menumpang')->default(false);
            
            // Kondisi rumah sebelum bencana
            $table->boolean('kondisi_baik')->default(false);
            $table->boolean('kondisi_rusak_ringan')->default(false);
            $table->boolean('kondisi_rusak_sedang')->default(false);
            $table->boolean('kondisi_rusak_berat')->default(false);
            
            // Kerusakan akibat bencana
            $table->boolean('kerusakan_tidak_ada')->default(false);
            $table->boolean('kerusakan_ringan')->default(false);
            $table->boolean('kerusakan_sedang')->default(false);
            $table->boolean('kerusakan_berat')->default(false);
            $table->boolean('kerusakan_hancur')->default(false);
            
            // Status tempat tinggal saat ini
            $table->boolean('tinggal_rumah_sendiri')->default(false);
            $table->boolean('tinggal_rumah_saudara')->default(false);
            $table->boolean('tinggal_mengungsi')->default(false);
            $table->boolean('tinggal_tenda')->default(false);
            
            // Penghasilan per bulan sebelum bencana
            $table->string('penghasilan_suami')->nullable();
            $table->string('bidang_suami')->nullable();
            $table->string('penghasilan_istri')->nullable();
            $table->string('bidang_istri')->nullable();
            $table->string('penghasilan_lainnya')->nullable();
            $table->string('bidang_lainnya')->nullable();
            
            // Relation to Bencana
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('form6');
    }
};
