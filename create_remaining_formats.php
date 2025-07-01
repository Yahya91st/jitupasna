<?php

/**
 * Script untuk membuat model dan migrasi untuk Format2Form4 - Format17Form4
 * Format1Form4, Format5Form4, dan Format6Form4 sudah dibuat sebelumnya
 */

$formats = [
    2 => ['name' => 'Format2Form4', 'description' => 'Sektor Pendidikan'],
    3 => ['name' => 'Format3Form4', 'description' => 'Sektor Kesehatan'],
    4 => ['name' => 'Format4Form4', 'description' => 'Sektor Perumahan'],
    7 => ['name' => 'Format7Form4', 'description' => 'Sektor Transportasi'],
    8 => ['name' => 'Format8Form4', 'description' => 'Sektor Komunikasi'],
    9 => ['name' => 'Format9Form4', 'description' => 'Sektor Ekonomi'],
    10 => ['name' => 'Format10Form4', 'description' => 'Sektor Keuangan'],
    11 => ['name' => 'Format11Form4', 'description' => 'Sektor Industri'],
    12 => ['name' => 'Format12Form4', 'description' => 'Sektor Perdagangan'],
    13 => ['name' => 'Format13Form4', 'description' => 'Sektor Pertanian'],
    14 => ['name' => 'Format14Form4', 'description' => 'Sektor Peternakan'],
    15 => ['name' => 'Format15Form4', 'description' => 'Sektor Pemerintahan'],
    16 => ['name' => 'Format16Form4', 'description' => 'Sektor Sosial'],
    17 => ['name' => 'Format17Form4', 'description' => 'Sektor Lingkungan'],
];

// Basic fields yang ada di semua format
$basicFields = [
    'bencana_id' => 'integer',
    'nama_kampung' => 'string',
    'nama_distrik' => 'string',
];

// Contoh fields umum yang bisa digunakan untuk berbagai sektor
$commonFields = [
    // Kerusakan infrastruktur
    'bangunan_rusak_berat' => 'integer',
    'bangunan_rusak_sedang' => 'integer', 
    'bangunan_rusak_ringan' => 'integer',
    'harga_satuan_bangunan' => 'decimal:15,2',
    
    // Kerusakan peralatan
    'peralatan_rusak_berat' => 'integer',
    'peralatan_rusak_sedang' => 'integer',
    'peralatan_rusak_ringan' => 'integer',
    'harga_satuan_peralatan' => 'decimal:15,2',
    
    // Kerugian operasional
    'kerugian_pendapatan_harian' => 'decimal:15,2',
    'lama_gangguan_hari' => 'integer',
    'biaya_pemulihan' => 'decimal:15,2',
    'biaya_sementara' => 'decimal:15,2',
    
    // Biaya pembersihan
    'biaya_tenaga_kerja' => 'decimal:15,2',
    'biaya_alat_berat' => 'decimal:15,2',
    'biaya_material' => 'decimal:15,2',
    'biaya_lain_lain' => 'decimal:15,2',
];

function generateModelContent($formatNumber, $className, $description) {
    global $basicFields, $commonFields;
    
    $tableName = strtolower($className) . 's';
    
    $fillableFields = array_merge(array_keys($basicFields), array_keys($commonFields));
    $fillableString = "'" . implode("',\n        '", $fillableFields) . "'";
    
    $castsArray = [];
    foreach ($basicFields as $field => $type) {
        if ($type === 'integer') {
            $castsArray[] = "'$field' => 'integer'";
        } elseif ($type === 'string') {
            continue; // strings don't need casting
        }
    }
    
    foreach ($commonFields as $field => $type) {
        if (strpos($type, 'decimal') !== false) {
            $castsArray[] = "'$field' => 'decimal:2'";
        } elseif ($type === 'integer') {
            $castsArray[] = "'$field' => 'integer'";
        }
    }
    
    $castsString = implode(",\n        ", $castsArray);
    
    return "<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class $className extends Model
{
    use SoftDeletes;

    protected \$table = '$tableName';

    protected \$fillable = [
        $fillableString,
    ];

    protected \$casts = [
        $castsString,
    ];

    protected \$dates = [
        'deleted_at',
    ];

    /**
     * Relationship dengan Bencana
     */
    public function bencana(): BelongsTo
    {
        return \$this->belongsTo(Bencana::class);
    }

    /**
     * Relationship dengan Rekap
     */
    public function rekap(): BelongsTo
    {
        return \$this->belongsTo(Rekap::class, 'bencana_id', 'bencana_id');
    }

    /**
     * Calculate total kerusakan bangunan
     */
    public function getTotalKerusakanBangunanAttribute()
    {
        \$total_bangunan_rusak = (\$this->bangunan_rusak_berat ?? 0) +
                                (\$this->bangunan_rusak_sedang ?? 0) +
                                (\$this->bangunan_rusak_ringan ?? 0);
        
        return \$total_bangunan_rusak * (\$this->harga_satuan_bangunan ?? 0);
    }

    /**
     * Calculate total kerusakan peralatan
     */
    public function getTotalKerusakanPeralatanAttribute()
    {
        \$total_peralatan_rusak = (\$this->peralatan_rusak_berat ?? 0) +
                                 (\$this->peralatan_rusak_sedang ?? 0) +
                                 (\$this->peralatan_rusak_ringan ?? 0);
        
        return \$total_peralatan_rusak * (\$this->harga_satuan_peralatan ?? 0);
    }

    /**
     * Calculate total kerugian operasional
     */
    public function getTotalKerugianOperasionalAttribute()
    {
        return (\$this->kerugian_pendapatan_harian ?? 0) * (\$this->lama_gangguan_hari ?? 0);
    }

    /**
     * Calculate total biaya pemulihan
     */
    public function getTotalBiayaPemulihanAttribute()
    {
        return (\$this->biaya_pemulihan ?? 0) +
               (\$this->biaya_sementara ?? 0) +
               (\$this->biaya_tenaga_kerja ?? 0) +
               (\$this->biaya_alat_berat ?? 0) +
               (\$this->biaya_material ?? 0) +
               (\$this->biaya_lain_lain ?? 0);
    }

    /**
     * Calculate grand total kerusakan + kerugian
     */
    public function getGrandTotalAttribute()
    {
        return \$this->total_kerusakan_bangunan + 
               \$this->total_kerusakan_peralatan + 
               \$this->total_kerugian_operasional + 
               \$this->total_biaya_pemulihan;
    }
}";
}

function generateMigrationContent($formatNumber, $className, $description) {
    global $basicFields, $commonFields;
    
    $tableName = strtolower($className) . 's';
    
    $fields = [];
    
    // Basic fields
    $fields[] = "\$table->unsignedBigInteger('bencana_id');";
    $fields[] = "\$table->string('nama_kampung');";
    $fields[] = "\$table->string('nama_distrik');";
    $fields[] = "";
    $fields[] = "// Kerusakan Infrastruktur - $description";
    
    // Common fields
    foreach ($commonFields as $field => $type) {
        if (strpos($type, 'decimal') !== false) {
            list($precision, $scale) = explode(',', str_replace(['decimal:', ''], ['', ''], $type));
            $fields[] = "\$table->decimal('$field', $precision, $scale)->nullable()->default(0);";
        } elseif ($type === 'integer') {
            $fields[] = "\$table->integer('$field')->nullable()->default(0);";
        }
    }
    
    $fieldsString = implode("\n            ", $fields);
    
    return "    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('$tableName', function (Blueprint \$table) {
            \$table->id();
            $fieldsString
            
            \$table->timestamps();
            \$table->softDeletes();
            
            // Foreign key constraints
            \$table->foreign('bencana_id')->references('id')->on('bencana')->onDelete('cascade');
            
            // Indexes for better performance
            \$table->index('bencana_id');
            \$table->index(['nama_kampung', 'nama_distrik']);
        });
    }";
}

echo "Starting to create models and migrations for remaining formats...\n";

foreach ($formats as $formatNumber => $info) {
    $className = $info['name'];
    $description = $info['description'];
    
    echo "Creating $className ($description)...\n";
    
    // Generate model content
    $modelContent = generateModelContent($formatNumber, $className, $description);
    $modelPath = "app/Models/$className.php";
    
    // Write model file
    file_put_contents($modelPath, $modelContent);
    echo "✓ Model created: $modelPath\n";
    
    // Create migration using artisan
    $tableName = strtolower($className) . 's';
    $migrationCommand = "php artisan make:migration create_{$tableName}_table";
    
    echo "Executing: $migrationCommand\n";
    $output = shell_exec($migrationCommand . " 2>&1");
    echo $output . "\n";
    
    // Find the migration file that was just created
    $migrationsDir = 'database/migrations';
    $migrationFiles = glob("$migrationsDir/*_create_{$tableName}_table.php");
    
    if (!empty($migrationFiles)) {
        $migrationFile = end($migrationFiles); // Get the latest one
        echo "Found migration file: $migrationFile\n";
        
        // Read the migration file
        $migrationFileContent = file_get_contents($migrationFile);
        
        // Replace the up() method
        $migrationContent = generateMigrationContent($formatNumber, $className, $description);
        
        $newMigrationContent = preg_replace(
            '/public function up\(\): void\s*\{.*?\}/s',
            $migrationContent,
            $migrationFileContent
        );
        
        // Write back to migration file
        file_put_contents($migrationFile, $newMigrationContent);
        echo "✓ Migration updated: $migrationFile\n";
        
        // Run the migration
        echo "Running migration for $tableName...\n";
        $migrateOutput = shell_exec("php artisan migrate --path=$migrationFile 2>&1");
        echo $migrateOutput . "\n";
    } else {
        echo "ERROR: Could not find migration file for $tableName\n";
    }
    
    echo "---\n";
}

echo "\nAll models and migrations have been created!\n";
echo "Summary:\n";
foreach ($formats as $formatNumber => $info) {
    echo "✓ Format$formatNumber - {$info['description']}\n";
}

echo "\nNote: Format1, Format5, and Format6 were created manually with specific structures.\n";
echo "Other formats use a generic structure that can be customized as needed.\n";
