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
        Schema::create('form10', function (Blueprint $table) {
            $table->id();

            $table->string('sektor')->nullable();
            $table->string('sub_sektor')->nullable();
            $table->string('lokasi')->nullable();
            $table->text('hasil_survey')->nullable();
            $table->text('hasil_wawancara')->nullable();
            $table->text('hasil_pendataan_skpd')->nullable();
            $table->text('kebutuhan_pemulihan')->nullable();
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
        Schema::dropIfExists('form10');
    }
};
