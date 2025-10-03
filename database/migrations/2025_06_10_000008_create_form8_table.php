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
        Schema::create('form8', function (Blueprint $table) {
            $table->id();
            
            // Basic Information
            $table->string('sektor')->nullable();
            $table->string('sub_sektor')->nullable();
            $table->text('komponen_kerusakan')->nullable();
            $table->string('lokasi')->nullable();
            
            // Data Kerusakan (RB = Rusak Berat, RS = Rusak Sedang, RR = Rusak Ringan)
            $table->integer('data_kerusakan_rb')->default(0);
            $table->integer('data_kerusakan_rs')->default(0);
            $table->integer('data_kerusakan_rr')->default(0);
            
            // Harga Satuan (dalam Rupiah)
            $table->decimal('harga_satuan_rb', 15, 2)->default(0);
            $table->decimal('harga_satuan_rs', 15, 2)->default(0);
            $table->decimal('harga_satuan_rr', 15, 2)->default(0);
            
            // Nilai Kerusakan (Damage)
            $table->decimal('nilai_kerusakan_rb', 15, 2)->default(0);
            $table->decimal('nilai_kerusakan_rs', 15, 2)->default(0);
            $table->decimal('nilai_kerusakan_rr', 15, 2)->default(0);
            
            // Perkiraan Kerugian (Losses)
            $table->decimal('perkiraan_kerugian', 15, 2)->default(0);
            
            // Kerusakan + Kerugian
            $table->decimal('total_kerusakan_kerugian', 15, 2)->default(0);
            
            // Kebutuhan
            $table->decimal('kebutuhan', 15, 2)->default(0);
            
            // Additional fields for dynamic rows
            $table->json('dynamic_rows')->nullable(); // To store multiple rows data as JSON
            
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
        Schema::dropIfExists('form8');
    }
};
