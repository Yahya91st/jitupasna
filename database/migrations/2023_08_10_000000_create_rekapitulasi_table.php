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
        Schema::create('rekapitulasi', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('bencana_id')->nullable();
            $table->string('sektor');
            $table->string('sub_sektor');
            $table->string('lokasi');
            $table->text('jenis_kebutuhan');
            $table->text('rincian_kebutuhan');
            $table->decimal('jumlah_unit', 15, 2)->default(0);
            $table->string('satuan')->nullable();
            $table->decimal('harga_satuan', 15, 2)->default(0);
            $table->decimal('total_kebutuhan', 15, 2)->default(0);
            $table->string('prioritas')->nullable(); // High, Medium, Low
            $table->string('durasi_penyelesaian')->nullable();
            $table->string('penanggung_jawab')->nullable();
            $table->text('keterangan')->nullable();            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->timestamps();
            
            // Foreign keys will be added in the final migration: 9999_12_31_235959_add_all_foreign_key_constraints.php
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rekapitulasi');
    }
};
