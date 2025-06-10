<?php
use App\Models\EnvironmentalReport;
require_once 'vendor/autoload.php';

$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

try {
    // Try creating a test record
    $report = EnvironmentalReport::create([
        'bencana_id' => 1, // Use a valid bencana_id that exists
        'report_type' => 'damage',
        'ekosistem' => 'darat',
        'jenis_kerusakan' => 'Test Damage',
        'rb' => 1,
        'rs' => 2, 
        'rr' => 3,
        'harga_rb' => 1000,
        'harga_rs' => 2000,
        'harga_rr' => 3000
    ]);
    
    echo "Report created successfully with ID: " . $report->id;
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}
