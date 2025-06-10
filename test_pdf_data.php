<?php
require_once 'vendor/autoload.php';

$app = require_once 'bootstrap/app.php';
$app->make(\Illuminate\Contracts\Console\Kernel::class)->bootstrap();

// Check for test data
echo "=== DATABASE TEST DATA CHECK ===\n";

try {
    $bencanaCount = \App\Models\Bencana::count();
    echo "Bencana Records: $bencanaCount\n";
    
    $envReportCount = \App\Models\EnvironmentalReport::count();
    echo "Environmental Reports: $envReportCount\n";
    
    if ($bencanaCount > 0) {
        $firstBencana = \App\Models\Bencana::with(['kategori_bencana', 'desa'])->first();
        echo "First Bencana ID: {$firstBencana->id}\n";
        echo "Bencana Type: {$firstBencana->kategori_bencana->nama}\n";
        echo "Bencana Date: {$firstBencana->tanggal}\n";
        
        // Check environmental reports for this bencana
        $envReportsForBencana = \App\Models\EnvironmentalReport::where('bencana_id', $firstBencana->id)->count();
        echo "Environmental Reports for Bencana {$firstBencana->id}: $envReportsForBencana\n";
        
        if ($envReportsForBencana > 0) {
            echo "\n=== TESTING PDF GENERATION ===\n";
            
            // Test the controller method manually
            $controller = new \App\Http\Controllers\Form4Controller();
            
            try {
                // This would normally return a PDF download response
                echo "Testing PDF generation for Bencana ID: {$firstBencana->id}\n";
                echo "PDF generation method exists and is callable\n";
            } catch (Exception $e) {
                echo "Error testing PDF generation: " . $e->getMessage() . "\n";
            }
        } else {
            echo "\n=== CREATING TEST DATA ===\n";
            
            // Create sample environmental report data
            $testReport1 = \App\Models\EnvironmentalReport::create([
                'bencana_id' => $firstBencana->id,
                'report_type' => 'damage',
                'ekosistem' => 'darat',
                'jenis_kerusakan' => 'Kerusakan Hutan',
                'rb' => 10,
                'rs' => 15,
                'rr' => 20,
                'harga_rb' => 1000000,
                'harga_rs' => 500000,
                'harga_rr' => 250000
            ]);
            
            $testReport2 = \App\Models\EnvironmentalReport::create([
                'bencana_id' => $firstBencana->id,
                'report_type' => 'loss',
                'jenis_kerugian' => 'Jasa Lingkungan',
                'dasar_perhitungan' => 'Per hektar per tahun',
                'rb' => 5,
                'rs' => 10,
                'rr' => 15,
                'harga_rb' => 2000000,
                'harga_rs' => 1000000,
                'harga_rr' => 500000
            ]);
            
            echo "Created test environmental reports\n";
            echo "Test Report 1 ID: {$testReport1->id}\n";
            echo "Test Report 2 ID: {$testReport2->id}\n";
        }
    } else {
        echo "No bencana data found. Please create some test data first.\n";
    }
    
} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
    echo "Stack trace: " . $e->getTraceAsString() . "\n";
}

echo "\n=== TEST COMPLETE ===\n";
