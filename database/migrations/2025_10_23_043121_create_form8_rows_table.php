<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('form8_rows', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('form8_id');
            $table->string('sektor_sub_sektor')->nullable();
            $table->string('komponen_kerusakan')->nullable();
            $table->string('lokasi')->nullable();
            $table->integer('data_kerusakan_rb')->nullable();
            $table->integer('data_kerusakan_rs')->nullable();
            $table->integer('data_kerusakan_rr')->nullable();
            $table->decimal('harga_satuan_rb', 16, 2)->nullable();
            $table->decimal('harga_satuan_rs', 16, 2)->nullable();
            $table->decimal('harga_satuan_rr', 16, 2)->nullable();
            $table->decimal('nilai_kerusakan_rb', 16, 2)->nullable();
            $table->decimal('nilai_kerusakan_rs', 16, 2)->nullable();
            $table->decimal('nilai_kerusakan_rr', 16, 2)->nullable();
            $table->decimal('perkiraan_kerugian', 16, 2)->nullable();
            $table->decimal('jumlah_kerusakan_kerugian', 16, 2)->nullable();
            $table->decimal('kebutuhan', 16, 2)->nullable();
            $table->timestamps();

            $table->foreign('form8_id')->references('id')->on('form8')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('form8_rows');
    }
};