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
        Schema::create('rekap', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('bencana_id');
            
            // Format 1-17 Form4 IDs - nullable karena tidak semua format harus diisi
            $table->unsignedBigInteger('format1_form4_id')->nullable();
            $table->unsignedBigInteger('format2_form4_id')->nullable();
            $table->unsignedBigInteger('format3_form4_id')->nullable();
            $table->unsignedBigInteger('format4_form4_id')->nullable();
            $table->unsignedBigInteger('format5_form4_id')->nullable();
            $table->unsignedBigInteger('format6_form4_id')->nullable();
            $table->unsignedBigInteger('format7_form4_id')->nullable();
            $table->unsignedBigInteger('format8_form4_id')->nullable();
            $table->unsignedBigInteger('format9_form4_id')->nullable();
            $table->unsignedBigInteger('format10_form4_id')->nullable();
            $table->unsignedBigInteger('format11_form4_id')->nullable();
            $table->unsignedBigInteger('format12_form4_id')->nullable();
            $table->unsignedBigInteger('format13_form4_id')->nullable();
            $table->unsignedBigInteger('format14_form4_id')->nullable();
            $table->unsignedBigInteger('format15_form4_id')->nullable();
            $table->unsignedBigInteger('format16_form4_id')->nullable();
            $table->unsignedBigInteger('format17_form4_id')->nullable();
            
            // Additional fields
            $table->string('nama_kampung')->nullable();
            $table->string('nama_distrik')->nullable();
            $table->text('catatan')->nullable();
            $table->decimal('total_kerusakan', 15, 2)->default(0);
            $table->decimal('total_kerugian', 15, 2)->default(0);
            $table->enum('status', ['draft', 'completed', 'verified'])->default('draft');
            
            $table->timestamps();
            $table->softDeletes();
            
            // Indexes for performance
            $table->index('bencana_id');
            $table->index('status');
            $table->index(['bencana_id', 'status']);
            $table->unique(['bencana_id', 'nama_kampung', 'nama_distrik'], 'unique_rekap_per_lokasi');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rekap');
    }
};
