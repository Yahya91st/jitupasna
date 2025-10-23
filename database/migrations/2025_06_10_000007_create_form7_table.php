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
        Schema::create('form7', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('bencana_id');
            $table->string('desa_kelurahan');
            $table->string('kecamatan');
            $table->string('kabupaten');
            $table->date('tanggal');
            $table->integer('jarak_bencana');
            $table->string('tempat_sesi');
            $table->integer('jumlah_peserta');
            $table->integer('jumlah_perempuan');
            $table->integer('jumlah_laki_laki');
            $table->text('komposisi_peserta');
            $table->string('fasilitator');
            $table->string('pencatat');
            
            // CHECKLIST PERSIAPAN
            $table->boolean('persiapan_pra_fgd');   
            $table->boolean('pembagian_tugas_pelaksana');   
            $table->boolean('perkenalan_pengantar');    
            $table->boolean('pembahasan');  
            $table->boolean('pendalaman_tanya_jawab');  
            $table->boolean('penyimpulan_penutupan');   

            // A. Akses Hak
            $table->text('akses_hak_bekerja');
            $table->text('akses_hak_jamsos');
            $table->text('akses_hak_perlindungan');
            $table->text('akses_hak_kesehatan');
            $table->text('akses_hak_pendidikan');

            // B. Fungsi Pranata
            $table->text('fungsi_pranata_sosial');
            $table->text('fungsi_pranata_ekonomi');
            $table->text('fungsi_pranata_agama');
            $table->text('fungsi_pranata_pemerintahan');

            // C. Resiko Kerentanan
            $table->text('resiko_kerentanan_sosial');
            $table->text('resiko_kerentanan_ekonomi');
            $table->text('resiko_kerentanan_geografis');

            // ...existing code...
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('form7');
    }
};
