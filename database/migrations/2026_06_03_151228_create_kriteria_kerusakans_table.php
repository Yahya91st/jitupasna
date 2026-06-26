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
        Schema::create('kriteria_kerusakans', function (Blueprint $table) {
            $table->id();

            $table->enum('tingkat', [
                'hancur_total',
                'berat',
                'sedang',
                'ringan'
            ]);

            $table->decimal('persentase', 5, 2);

            $table->text('deskripsi')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kriteria_kerusakans');
    }
};
