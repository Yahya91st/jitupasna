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
        Schema::create('form2', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('bencana_id');
            $table->string('nomor_surat')->unique();
            $table->string('tentang');
            $table->string('lokasi');
            $table->string('tanggal_ditetapkan'); // Changed to string for formatted date
            $table->string('tempat_ditetapkan');
            $table->string('pejabat_penandatangan');
            $table->string('nama_penandatangan');
            // $table->text('keputusan');
            $table->text('tim_kerja');
            $table->text('tugas_tim');
            $table->string('penanggung_jawab');
            $table->text('tembusan');
            // $table->foreignId('created_by')->nullable()->constrained('users');
            // $table->foreignId('updated_by')->nullable()->constrained('users');
            $table->timestamps();
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('form2');
    }
};
