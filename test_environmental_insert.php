<?php

require_once 'vendor/autoload.php';

// Load Laravel application
$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use App\Models\EnvironmentalReport;

echo "Testing Environmental Report insertion...\n";

try {
    // Test data for Kehilangan Jasa Lingkungan
    $testData = [
        'bencana_id' => 1, // Assuming there's a bencana with ID 1
        'report_type' => 'loss',
        'jenis_kerugian' => 'kehilangan_jasa_lingkungan',
        'jenis' => 'Test Jasa Lingkungan Item',
        'dasar_perhitungan' => 'Test calculation basis',
        'rb' => 10,
        'rs' => 5,
        'rr' => 3,
        'harga_rb' => 1000000.00,
        'harga_rs' => 500000.00,
        'harga_rr' => 250000.00,
    ];
    
    echo "Attempting to create environmental report...\n";
    $report = EnvironmentalReport::create($testData);
    
    echo "✅ Success! Environmental report created with ID: " . $report->id . "\n";
    echo "Data stored: \n";
    echo "- Bencana ID: " . $report->bencana_id . "\n";
    echo "- Report Type: " . $report->report_type . "\n";
    echo "- Jenis Kerugian: " . $report->jenis_kerugian . "\n";
    echo "- Jenis: " . $report->jenis . "\n";
    echo "- Dasar Perhitungan: " . $report->dasar_perhitungan . "\n";
    echo "- RB: " . $report->rb . "\n";
    echo "- RS: " . $report->rs . "\n";
    echo "- RR: " . $report->rr . "\n";
    echo "- Harga RB: " . $report->harga_rb . "\n";
    echo "- Harga RS: " . $report->harga_rs . "\n";
    echo "- Harga RR: " . $report->harga_rr . "\n";
    
    // Test retrieving the data
    echo "\nTesting data retrieval...\n";
    $retrieved = EnvironmentalReport::where('report_type', 'loss')
                                   ->where('jenis_kerugian', 'kehilangan_jasa_lingkungan')
                                   ->first();
    
    if ($retrieved) {
        echo "✅ Data retrieved successfully!\n";
        echo "Retrieved ID: " . $retrieved->id . "\n";
    } else {
        echo "❌ Failed to retrieve data\n";
    }
    
} catch (Exception $e) {
    echo "❌ Error: " . $e->getMessage() . "\n";
    echo "Stack trace: " . $e->getTraceAsString() . "\n";
}

echo "\nTest completed.\n";
