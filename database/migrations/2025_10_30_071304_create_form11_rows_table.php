<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('form11_rows', function (Blueprint $table) {
            $table->id();

            // FK to form11tables
            $table->unsignedBigInteger('form11_id')->index();

            // Reference-table / repeating row fields (per table row)
            $table->string('sector_slug')->nullable();     // e.g. perumahan, infra, ekonomi, sosial, lintas
            $table->string('component_key')->nullable();   // e.g. pembangunan, penggantian, bantuan...
            $table->unsignedSmallInteger('row_index')->nullable(); // 1..3

            $table->string('kegiatan')->nullable();
            $table->string('lokasi')->nullable();
            $table->decimal('volume', 14, 2)->nullable();
            $table->decimal('harga', 18, 2)->nullable();
            $table->decimal('jumlah', 18, 2)->nullable();
            $table->text('keterangan')->nullable();

            // Main form fields (requested: all inputs from the blade)
            // Note: these will be stored per row as requested by your instruction.
            $table->string('main_lokasi')->nullable();
            $table->string('jenis_kebutuhan')->nullable();
            $table->text('rincian_kebutuhan')->nullable();
            $table->decimal('jumlah_unit', 14, 2)->nullable();
            $table->string('satuan')->nullable();
            $table->decimal('harga_satuan', 18, 2)->nullable();
            $table->decimal('total_kebutuhan', 18, 2)->nullable();
            $table->string('prioritas')->nullable();
            $table->string('durasi_penyelesaian')->nullable();
            $table->string('penanggung_jawab')->nullable();

            $table->timestamps();
            
            // Helpful indexes
            $table->index(['sector_slug', 'component_key', 'row_index']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('form11_rows');
    }
};
