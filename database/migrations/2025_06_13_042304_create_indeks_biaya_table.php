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
        Schema::create('indeks_biaya', function (Blueprint $table) {
            $table->id();
            $table->string('provinsi');
            $table->string('kota');
            $table->decimal('indeks_umum', 5, 4);
            $table->decimal('indeks_perumahan', 5, 4);
            $table->decimal('indeks_kesehatan', 5, 4);
            $table->decimal('indeks_pendidikan', 5, 4);
            $table->decimal('indeks_sosial', 5, 4)->nullable();
            $table->decimal('indeks_ekonomi', 5, 4)->nullable();
            $table->decimal('indeks_infrastruktur', 5, 4)->nullable();
            $table->decimal('indeks_pemerintahan', 5, 4)->nullable();
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
        Schema::dropIfExists('indeks_biaya');
    }
};
