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
            $table->unsignedBigInteger('bencana_id');
            $table->string('kop_surat')->nullable();
            $table->string('nomor_surat');
            $table->date('nomor_surat_date');
            $table->enum('sifat', ['Segera', 'Biasa', 'Rahasia'])->default('Biasa');
            $table->integer('lampiran')->nullable();
            $table->text('kepada_jabatan');
            $table->string('lokasi_pdna');
            $table->string('hari_tanggal');
            $table->string('waktu');
            $table->string('tempat');
            $table->text('agenda');
            $table->string('nama_penandatangan');
            $table->text('tembusan')->nullable();
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