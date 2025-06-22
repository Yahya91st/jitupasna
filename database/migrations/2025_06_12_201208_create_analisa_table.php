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
        Schema::create('analisa', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('bencana_id')->nullable();
            $table->string('sektor');
            $table->string('sub_sektor');
            $table->string('lokasi');
            $table->text('hasil_survey');
            $table->text('hasil_wawancara');
            $table->text('hasil_pendataan_skpd');
            $table->text('kebutuhan_pemulihan');
            $table->decimal('jumlah_kebutuhan', 15, 2);
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->timestamps();
            
            $table->foreign('bencana_id')->references('id')->on('bencana')->onDelete('cascade');
            $table->foreign('created_by')->references('id')->on('users');
            $table->foreign('updated_by')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('analisa');
    }
};
