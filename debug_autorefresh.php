<?php

// Simple test script to debug auto-refresh issues
echo "=== Auto-refresh Debug Test ===\n";

// Test 1: Check if route exists
echo "\n1. Testing route availability...\n";
$routes = `php artisan route:list --name=rekap.auto-refresh`;
echo "Route: " . $routes . "\n";

// Test 2: Check if controller method exists
echo "\n2. Checking controller method...\n";
if (method_exists('App\Http\Controllers\RekapController', 'autoRefresh')) {
    echo "✓ autoRefresh method exists in RekapController\n";
} else {
    echo "✗ autoRefresh method NOT found in RekapController\n";
}

// Test 3: Try to create a Rekap instance (to test model)
echo "\n3. Testing Rekap model...\n";
try {
    require_once __DIR__ . '/vendor/autoload.php';
    
    $app = require_once __DIR__ . '/bootstrap/app.php';
    $kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);
    $response = $kernel->handle(
        $request = Illuminate\Http\Request::capture()
    );
    
    $rekapCount = App\Models\Rekap::count();
    echo "✓ Rekap model works, found {$rekapCount} records\n";
} catch (Exception $e) {
    echo "✗ Error with Rekap model: " . $e->getMessage() . "\n";
}

echo "\n=== Test Complete ===\n";
