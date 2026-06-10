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
        Schema::create('bencanas', function (Blueprint $table) {
            $table->id();
            $table->enum('jenis_bencana', [
                'banjir',
                'kebakaran',
                'gempa_bumi',
                'tanah_longsor',
                'angin_puting_beliung',
                'tsunami',
                'letusan_gunung_berapi',
                'kekeringan',
                'abrasi',
                'gelombang_pasang',
                'kebakaran_hutan_lahan',
                'wabah_penyakit',
                'lainnya',
            ]);
            $table->date('tanggal');
            $table->string('province_code');
            $table->string('regency_code');
            $table->string('district_code');
            $table->json('village_codes');
            $table->string('gambar')->nullable();
            $table->text('deskripsi')->nullable();
            $table->boolean('verifikasi')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bencanas');
    }
};
