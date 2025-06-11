<?php

require_once __DIR__ . '/vendor/autoload.php';

$app = require_once __DIR__ . '/bootstrap/app.php';

$app->make(\Illuminate\Contracts\Console\Kernel::class)->bootstrap();

$migrator = $app->make('migrator');
$migrator->run([
    __DIR__ . '/database/migrations'
]);

echo "Migration completed successfully.";
