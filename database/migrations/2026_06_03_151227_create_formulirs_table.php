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
        Schema::create('formulirs', function (Blueprint $table) {
        $table->id();

        $table->foreignId('laporan_id')
            ->constrained('laporan_bencanas')
            ->cascadeOnDelete();

        $table->foreignId('format_id')
            ->constrained('format_formulirs')
            ->cascadeOnDelete();
                
        $table->string('nama_kampung')->nullable();
        $table->string('nama_distrik')->nullable();


        $table->enum('status', [
            'draft',
            'submitted',
            'verified',
            'revision'
        ])->default('draft');

        $table->foreignId('verified_by')
            ->nullable()
            ->constrained('users')
            ->nullOnDelete();

        $table->timestamp('verified_at')->nullable();

        $table->text('catatan_revisi')->nullable();

        $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('formulirs');
    }
};
