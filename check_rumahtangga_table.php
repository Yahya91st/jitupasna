<?php

require __DIR__.'/vendor/autoload.php';

$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

if (Schema::hasTable('rumahtangga')) {
    echo "Table rumahtangga exists.\n";
    $columns = Schema::getColumnListing('rumahtangga');
    echo "Columns:\n";
    foreach ($columns as $column) {
        echo "- $column\n";
    }
} else {
    echo "Table rumahtangga does not exist.\n";
}
