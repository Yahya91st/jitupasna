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
        Schema::create('kajians', function (Blueprint $table) {
            $table->id();
            $table->unique('laporan_id');
            $table->text('peningkatan_resiko');
            $table->text('gangguan_akses');
            $table->text('kehilangan_akses');
            $table->enum('status_kajian',[
                'draft', 
                'revisi', 
                'final'
                ])->default('draft');
            $table->string('catatan_revisi');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kajians');
    }
};
