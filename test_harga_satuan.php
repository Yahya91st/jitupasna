<?php

require_once __DIR__ . '/vendor/autoload.php';

$app = require_once __DIR__ . '/bootstrap/app.php';

// Boot the application
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

echo "Testing Harga Satuan Format1Form4\n";

$data = App\Models\Format1Form4::first();
if ($data) {
    echo "ID: " . $data->id . "\n";
    echo "HSP: " . ($data->harga_satuan_permanen ?? 'NULL') . "\n";
    echo "HSNP: " . ($data->harga_satuan_non_permanen ?? 'NULL') . "\n";
} else {
    echo "No records found\n";
}
