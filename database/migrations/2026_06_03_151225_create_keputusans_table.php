    <?php

    use Illuminate\Database\Migrations\Migration;
    use Illuminate\Database\Schema\Blueprint;
    use Illuminate\Support\Facades\Schema;

    return new class extends Migration
    {
        public function up(): void
        {
            Schema::create('keputusans', function (Blueprint $table) {

                $table->id();

                $table->foreignId('laporan_id')
                    ->unique()
                    ->constrained('laporan_bencanas')
                    ->cascadeOnDelete();

                $table->enum('prioritas', [
                    'sangat_tinggi',
                    'tinggi',
                    'sedang',
                    'rendah',
                ]);

                $table->text('keputusan');

                $table->timestamps();
            });
        }

        public function down(): void
        {
            Schema::dropIfExists('keputusans');
        }
    };
