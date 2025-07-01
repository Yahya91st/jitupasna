<?php

require_once __DIR__ . '/vendor/autoload.php';

$app = require_once __DIR__ . '/bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

echo "Checking table columns\n";

$columns = DB::getSchemaBuilder()->getColumnListing('format1_form4s');

echo "Total columns: " . count($columns) . "\n";
foreach ($columns as $column) {
    echo $column . "\n";
}
