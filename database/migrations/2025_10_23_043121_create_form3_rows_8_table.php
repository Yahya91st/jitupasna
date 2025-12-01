<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('form3_rows_8', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('form3_id');
            $table->string('pertanyaan');
            $table->string('jawaban');
            $table->timestamps();

            $table->foreign('form3_id')->references('id')->on('form3')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('form3_rows');
    }
};