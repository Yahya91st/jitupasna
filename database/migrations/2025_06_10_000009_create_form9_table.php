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
        Schema::create('form9', function (Blueprint $table) {
            $table->id();

            $table->integer('pertanyaan_no')->nullable();
            $table->integer('jawaban_index')->nullable();
            $table->text('kuesioner_1')->nullable();
            $table->text('kuesioner_2')->nullable();
            $table->text('kuesioner_3')->nullable();
            $table->text('kuesioner_4')->nullable();
            $table->text('kuesioner_5')->nullable();
            $table->text('kuesioner_6')->nullable();
            $table->integer('jumlah')->nullable()->default(0);
            $table->decimal('persentase', 5, 2)->nullable()->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('form9');
    }
};
