<?php
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
require_once 'vendor/autoload.php';

$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

try {
    if (Schema::hasTable('environmental_reports')) {
        echo "Table 'environmental_reports' exists!\n";
        $columns = Schema::getColumnListing('environmental_reports');
        print_r($columns);
        echo "\n\nTable has " . count($columns) . " columns.";
        
        // Check for specific columns
        $requiredColumns = ['report_type', 'ekosistem', 'jenis_kerusakan', 'jenis_kerugian', 'jenis', 'dasar_perhitungan'];
        $missing = [];
        foreach ($requiredColumns as $col) {
            if (!in_array($col, $columns)) {
                $missing[] = $col;
            }
        }
        
        if (count($missing) > 0) {
            echo "\n\nMissing required columns: " . implode(', ', $missing);
        } else {
            echo "\n\nAll required columns exist!";
        }
    } else {
        echo "Table 'environmental_reports' doesn't exist!";
    }
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}
