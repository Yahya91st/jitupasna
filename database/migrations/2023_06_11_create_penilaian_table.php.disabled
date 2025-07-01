<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('penilaian', function (Blueprint $table) {
            $table->id();
            $table->foreignId('bencana_id')->constrained('bencana')->onDelete('cascade');
            $table->string('sektor');
            $table->string('sub_sektor');
            $table->text('komponen_kerusakan');
            $table->string('lokasi');
            $table->decimal('perkiraan_kerugian', 15, 2);
            $table->decimal('total_kerusakan_kerugian', 15, 2);
            $table->decimal('kebutuhan_rb', 15, 2);
            $table->decimal('kebutuhan_rs', 15, 2);
            $table->decimal('kebutuhan_rr', 15, 2);
            $table->decimal('harga_satuan', 15, 2);
            $table->decimal('nilai_kerusakan', 15, 2);
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('penilaian');
    }
};
