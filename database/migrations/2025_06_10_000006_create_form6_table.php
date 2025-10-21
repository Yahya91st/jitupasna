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
            $table->boolean('nafkah_pre_suami')->default(false);
            $table->boolean('nafkah_pre_istri')->default(false);
            $table->boolean('nafkah_pre_anak')->default(false);
            $table->boolean('nafkah_pre_lain')->default(false);
            $table->string('nafkah_pre_lain_text')->nullable();

            $table->boolean('nafkah_post_suami')->default(false);
            $table->boolean('nafkah_post_istri')->default(false);
            $table->boolean('nafkah_post_anak')->default(false);
            $table->boolean('nafkah_post_lain')->default(false);
            $table->string('nafkah_post_lain_text')->nullable();

            $table->boolean('sumber_pertanian')->default(false);
            $table->boolean('sumber_peternakan')->default(false);
            $table->boolean('sumber_dagang')->default(false);
            $table->boolean('sumber_industri')->default(false);
            $table->boolean('sumber_jasa')->default(false);
            $table->boolean('sumber_pegawai')->default(false);
            $table->boolean('sumber_pertukangan')->default(false);
            $table->boolean('sumber_lain')->default(false);
            $table->string('sumber_lain_text')->nullable();

            // Pertanyaan 4
            $table->string('penghasilan_hilang')->nullable();

            // Pertanyaan 5
            $table->boolean('bantuan_keterampilan')->default(false);
            $table->boolean('bantuan_peralatan')->default(false);
            $table->boolean('bantuan_modal')->default(false);
            $table->boolean('bantuan_pasar')->default(false);
            $table->boolean('bantuan_lain')->default(false);
            $table->string('bantuan_lain_text')->nullable();

            // Pertanyaan 6
            $table->boolean('cadangan_tabungan')->default(false);
            $table->boolean('cadangan_pinjaman')->default(false);
            $table->boolean('cadangan_barang')->default(false);
            $table->boolean('cadangan_ternak')->default(false);
            $table->boolean('cadangan_jamsos')->default(false);
            $table->boolean('cadangan_lain')->default(false);
            $table->string('cadangan_lain_text')->nullable();

            // Pertanyaan 7
            $table->boolean('dukungan_koperasi')->default(false);
            $table->boolean('dukungan_kelompok')->default(false);
            $table->boolean('dukungan_pinjaman')->default(false);
            $table->boolean('dukungan_pemerintah')->default(false);
            $table->boolean('dukungan_lain')->default(false);
            $table->string('dukungan_lain_text')->nullable();

            // Pertanyaan 8
            $table->string('perlindungan')->nullable();

            // Pertanyaan 9
            $table->boolean('bantu_lindung_penyuluhan')->default(false);
            $table->boolean('bantu_lindung_moral')->default(false);
            $table->boolean('bantu_lindung_polisi')->default(false);
            $table->boolean('bantu_lindung_pos')->default(false);
            $table->boolean('bantu_lindung_rumah')->default(false);
            $table->boolean('bantu_lindung_lain')->default(false);
            $table->string('bantu_lindung_lain_text')->nullable();

            // Pertanyaan 10
            $table->boolean('masalah_rumah_relokasi')->default(false);
            $table->boolean('masalah_rumah_rusak')->default(false);
            $table->boolean('masalah_rumah_belum')->default(false);
            $table->boolean('masalah_rumah_lain')->default(false);
            $table->string('masalah_rumah_lain_text')->nullable();

            // Pertanyaan 11
            $table->boolean('tindakan_rumah_stimulus')->default(false);
            $table->boolean('tindakan_rumah_kredit')->default(false);
            $table->boolean('tindakan_rumah_teknis')->default(false);
            $table->boolean('tindakan_rumah_lain')->default(false);
            $table->string('tindakan_rumah_lain_text')->nullable();

            // Pertanyaan 12
            $table->string('perkiraan_tinggal')->nullable();
            $table->string('perkiraan_tempat_lain_text')->nullable();

            // Pertanyaan 13
            $table->boolean('makanan_bantuan')->default(false);
            $table->boolean('makanan_cadangan')->default(false);
            $table->boolean('makanan_tanaman')->default(false);
            $table->boolean('makanan_lain')->default(false);
            $table->string('makanan_lain_text')->nullable();

            // Pertanyaan 14
            $table->boolean('dukungan_pangan_langsung')->default(false);
            $table->boolean('dukungan_pangan_pulih')->default(false);
            $table->boolean('dukungan_pangan_gotong')->default(false);
            $table->boolean('dukungan_pangan_lain')->default(false);
            $table->string('dukungan_pangan_lain_text')->nullable();

            // Pertanyaan 15
            $table->boolean('air_kurang')->default(false);
            $table->boolean('air_kotor')->default(false);
            $table->boolean('air_simpan')->default(false);
            $table->boolean('air_lain')->default(false);
            $table->string('air_lain_text')->nullable();

            // Pertanyaan 16
            $table->boolean('dukungan_air_sedia')->default(false);
            $table->boolean('dukungan_air_pulih')->default(false);
            $table->boolean('dukungan_air_simpan')->default(false);
            $table->boolean('dukungan_air_lain')->default(false);
            $table->string('dukungan_air_lain_text')->nullable();

            // Pertanyaan 17
            $table->string('pelayanan_kesehatan')->nullable();

            // Pertanyaan 18
            $table->boolean('perbaikan_obat')->default(false);
            $table->boolean('perbaikan_medis')->default(false);
            $table->boolean('perbaikan_jarak')->default(false);
            $table->boolean('perbaikan_biaya')->default(false);
            $table->boolean('perbaikan_psiko')->default(false);
            $table->boolean('perbaikan_lain')->default(false);
            $table->string('perbaikan_lain_text')->nullable();

            // Pertanyaan 19
            $table->string('sekolah_terganggu')->nullable();

            // Pertanyaan 20
            $table->boolean('dukungan_pend_guru')->default(false);
            $table->boolean('dukungan_pend_alat')->default(false);
            $table->boolean('dukungan_pend_biaya')->default(false);
            $table->boolean('dukungan_pend_trans')->default(false);
            $table->boolean('dukungan_pend_dekat')->default(false);
            $table->boolean('dukungan_pend_bangun')->default(false);
            $table->boolean('dukungan_pend_lain')->default(false);
            $table->string('dukungan_pend_lain_text')->nullable();

            // Pertanyaan 21
            $table->string('agama_terganggu')->nullable();

            // Pertanyaan 22
            $table->boolean('dukungan_agama_stimulus')->default(false);
            $table->boolean('dukungan_agama_latih')->default(false);
            $table->boolean('dukungan_agama_izin')->default(false);
            $table->boolean('dukungan_agama_lain')->default(false);
            $table->string('dukungan_agama_lain_text')->nullable();

            // Pertanyaan 23
            $table->boolean('cegah_info')->default(false);
            $table->boolean('cegah_latih')->default(false);
            $table->boolean('cegah_rencana')->default(false);
            $table->boolean('cegah_fasilitas')->default(false);
            $table->boolean('cegah_warning')->default(false);
            $table->boolean('cegah_komunitas')->default(false);
            $table->boolean('cegah_budaya')->default(false);
            $table->boolean('cegah_lain')->default(false);
            $table->string('cegah_lain_text')->nullable();

            // Pertanyaan 24
            $table->boolean('butuh_anak')->default(false);
            $table->boolean('butuh_lansia')->default(false);
            $table->boolean('butuh_difabel')->default(false);
            $table->boolean('butuh_hamil')->default(false);
            $table->boolean('butuh_lain')->default(false);
            $table->string('butuh_lain_text')->nullable();

            // Pertanyaan 25
            $table->string('penghasilan_suami')->nullable();
            $table->string('bidang_suami')->nullable();
            $table->string('penghasilan_istri')->nullable();
            $table->string('bidang_istri')->nullable();
            $table->string('penghasilan_lainnya')->nullable();
            $table->string('bidang_lainnya')->nullable();

            // ...existing code...
            
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
