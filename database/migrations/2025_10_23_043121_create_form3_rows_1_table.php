<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('form3_rows_1', function (Blueprint $table) {
            $table->id();
            $table->foreignId('form3_id')->constrained('form3')->cascadeOnDelete();
            $table->string('Kategori')->nullable();   
            $table->string('Sub-Kategori')->nullable();
            $table->string('Jawaban')->nullable();
            $table->timestamps();


            $table->index(['form3_id', 'item_index']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('form3_rows');
    }
};