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
        Schema::create('rekap', function (Blueprint $table) {
            $table->unsignedBigInteger('id')->primary(); // id sama dengan bencana_id, tanpa auto increment
            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('bencana_id');
            
            // Additional fields
            $table->string('province_name')->nullable();
            $table->text('catatan')->nullable();
            $table->decimal('total_kerusakan', 15, 2)->default(0);
            $table->decimal('total_kerugian', 15, 2)->default(0);
            $table->enum('status', ['draft', 'completed', 'verified'])->default('draft');
            
            $table->timestamps();
            $table->softDeletes();
            
            // Indexes for performance
            $table->index('bencana_id');
            $table->index('status');
            $table->index(['bencana_id', 'status']);
            $table->unique(['bencana_id'], 'unique_rekap_per_bencana');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rekap');
    }
};
