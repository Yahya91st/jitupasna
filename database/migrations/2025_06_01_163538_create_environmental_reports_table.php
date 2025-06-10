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
        Schema::create('environmental_reports', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('bencana_id');
            $table->enum('report_type', ['damage', 'loss']);
            
            // Columns for damage reports
            $table->enum('ekosistem', ['darat', 'laut', 'udara'])->nullable();
            $table->string('jenis_kerusakan')->nullable();
            
            // Columns for loss reports
            $table->enum('jenis_kerugian', [
                'kehilangan_jasa_lingkungan',
                'pencemaran_air',
                'pencemaran_udara'
            ])->nullable();
            $table->string('jenis')->nullable();
            $table->text('dasar_perhitungan')->nullable();
            
            // Common columns for both types
            $table->integer('rb')->nullable(); // Rusak Berat
            $table->integer('rs')->nullable(); // Rusak Sedang
            $table->integer('rr')->nullable(); // Rusak Ringan
            $table->decimal('harga_rb', 15, 2)->nullable();
            $table->decimal('harga_rs', 15, 2)->nullable();
            $table->decimal('harga_rr', 15, 2)->nullable();
            $table->text('catatan')->nullable();
            $table->timestamps();

            $table->foreign('bencana_id')->references('id')->on('bencana')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('environmental_reports');
    }
};
