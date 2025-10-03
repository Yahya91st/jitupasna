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
        Schema::create('form11', function (Blueprint $table) {
            $table->id();

            $table->string('sektor')->nullable();
            $table->string('sub_sektor')->nullable();
            $table->string('lokasi')->nullable();
            $table->text('jenis_kebutuhan')->nullable();
            $table->text('rincian_kebutuhan')->nullable();
            $table->integer('jumlah_unit')->nullable()->default(0);
            $table->string('satuan')->nullable();
            $table->decimal('harga_satuan', 15, 2)->nullable()->default(0);
            $table->decimal('total_kebutuhan', 15, 2)->nullable()->default(0);
            $table->string('prioritas')->nullable();
            $table->string('durasi_penyelesaian')->nullable();
            $table->string('penanggung_jawab')->nullable();
            $table->text('keterangan')->nullable();
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('form11');
    }
};
