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
        Schema::create('form1', function (Blueprint $table) {
            $table->id();
            $table->foreignId('bencana_id')->constrained('bencana')->onDelete('cascade');
            $table->string('nomor_surat');
            $table->enum('sifat', ['Segera', 'Biasa', 'Rahasia'])->default('Biasa');
            $table->string('lampiran')->nullable();
            $table->string('perihal')->default('Permohonan Keterlibatan dalam PDNA');
            $table->string('kepada');
            $table->string('lokasi_pdna');
            $table->date('hari_tanggal');
            $table->time('waktu');
            $table->string('tempat');
            $table->string('agenda')->default('Konsolidasi awal PDNA');
            $table->string('nama_penandatangan');            $table->string('jabatan_penandatangan');
            $table->text('tembusan')->nullable();
            $table->date('tanggal_surat')->default(now());
            $table->string('instansi_pengirim')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('form1');
    }
};