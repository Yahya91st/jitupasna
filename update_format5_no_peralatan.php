<?php

require_once 'vendor/autoload.php';

$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use App\Models\Format5Form4;

echo "Updating Format 5 calculations WITHOUT luas AND peralatan...\n";

$records = Format5Form4::all();
$updated = 0;

foreach ($records as $record) {
    $oldTotal = $record->total_kerusakan;
    
    // Force recalculate with new formula (without luas and peralatan)
    $record->total_kerusakan = $record->calculateTotalKerusakan();
    $record->total_kerugian = $record->calculateTotalKerugian();
    $record->save();
    
    $updated++;
    echo "Updated record {$record->id}: {$record->nama_kampung} - Old: {$oldTotal}, New: {$record->total_kerusakan}\n";
}

echo "Updated {$updated} records successfully (WITHOUT luas AND peralatan calculation)!\n";
