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
            $table->string('wilayah_bencana');
            $table->integer('jumlah_laki_laki')->default(0);
            $table->integer('jumlah_perempuan')->default(0);
            $table->integer('jumlah_rumah_tangga')->default(0);
            $table->integer('jumlah_rumah_sakit')->default(0);
            $table->integer('jumlah_puskesmas')->default(0);
            $table->integer('jumlah_posyandu')->default(0);
            $table->integer('jumlah_dokter')->default(0);
            $table->integer('jumlah_paramedis')->default(0);
            $table->integer('jumlah_bidan')->default(0);
            $table->integer('jumlah_kunjungan_puskesmas')->default(0);
            $table->integer('jumlah_balita')->default(0);
            $table->integer('jumlah_balita_gizi_buruk')->default(0);
            $table->integer('jumlah_balita_gizi_kurang')->default(0);
            $table->integer('jumlah_manula')->default(0);
            $table->integer('jumlah_penerima_jps_kesehatan')->default(0);
            $table->integer('jumlah_rumah_air_bersih')->default(0);
            $table->integer('jumlah_rumah_jamban')->default(0);
            $table->integer('jumlah_pasar')->default(0);
            $table->integer('jumlah_koperasi')->default(0);
            $table->integer('jumlah_tempat_wisata')->default(0);
            $table->integer('jumlah_masjid')->default(0);
            $table->integer('jumlah_gereja')->default(0);
            $table->integer('jumlah_wihara')->default(0);
            $table->integer('jumlah_pura')->default(0);
            $table->integer('jumlah_rumah_permanen')->default(0);
            $table->integer('jumlah_rumah_semi_permanen')->default(0);
            $table->integer('jumlah_rumah_non_permanen')->default(0);
            $table->integer('panjang_jalan_negara')->default(0);
            $table->integer('panjang_jalan_provinsi')->default(0);
            $table->integer('panjang_jalan_kabupaten')->default(0);
            $table->integer('jumlah_bangunan_bersejarah')->default(0);
            $table->integer('jumlah_produksi_pertanian')->default(0);
            $table->integer('jumlah_produksi_industri')->default(0);
            $table->decimal('harga_konstruksi_rumah', 15, 2)->default(0);
            $table->decimal('harga_konstruksi_gedung', 15, 2)->default(0);
            $table->decimal('harga_konstruksi_jalan', 15, 2)->default(0);
            $table->decimal('harga_konstruksi_jembatan', 15, 2)->default(0);
            $table->decimal('harga_konstruksi_pelabuhan', 15, 2)->default(0);
            $table->decimal('harga_sewa_rumah', 15, 2)->default(0);
            
            // Data Sekunder Akibat Bencana
            $table->text('sejarah_bencana')->nullable();
            $table->text('kronologis_bencana')->nullable();
            $table->text('wilayah_terdampak')->nullable();
            $table->integer('jumlah_korban_meninggal')->default(0);
            $table->integer('jumlah_korban_luka')->default(0);
            $table->integer('jumlah_korban_mengungsi')->default(0);
            $table->text('kerusakan_kerugian')->nullable();
            
            // Data Sekunder Akibat Bencana (Khusus)
            $table->text('pertanian_gangguan_ekonomi')->nullable();
            $table->text('pertanian_produk_terdampak')->nullable();
            $table->text('pertanian_pemulihan')->nullable();
            $table->text('nonpertanian_gangguan_ekonomi')->nullable();
            $table->text('nonpertanian_dampak_industri')->nullable();
            $table->text('nonpertanian_dampak_koperasi')->nullable();
            $table->text('nonpertanian_pemulihan')->nullable();
            $table->text('sosial_kehilangan_tempat_tinggal')->nullable();
            $table->text('sosial_penyandang_cacat')->nullable();
            $table->text('sosial_kegiatan_terdampak')->nullable();
            $table->text('pendidikan_gangguan')->nullable();
            $table->text('pendidikan_trauma')->nullable();
            $table->text('pendidikan_pemulihan')->nullable();
            $table->text('pemerintahan_gangguan_administrasi')->nullable();
            $table->text('pemerintahan_kehilangan_surat')->nullable();
            $table->text('pemerintahan_rencana_kontingensi')->nullable();
            $table->text('kesehatan_gangguan_layanan')->nullable();
            $table->text('kesehatan_dampak_menengah')->nullable();
            $table->text('kesehatan_pemulihan')->nullable();
            
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
