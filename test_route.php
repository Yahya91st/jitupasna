<?php

require_once __DIR__ . '/vendor/autoload.php';

$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);

// Simulate a request to auto-refresh route
$request = Illuminate\Http\Request::create('/rekap/auto-refresh', 'GET', [], [], [], [
    'HTTP_ACCEPT' => 'application/json',
    'HTTP_X_REQUESTED_WITH' => 'XMLHttpRequest'
]);

echo "=== Testing Auto-refresh Route ===\n";
echo "Request URL: " . $request->fullUrl() . "\n";
echo "Request Method: " . $request->method() . "\n";
echo "Request Headers:\n";
foreach ($request->headers->all() as $key => $value) {
    echo "  {$key}: " . implode(', ', $value) . "\n";
}

try {
    $response = $kernel->handle($request);
    
    echo "\nResponse Status: " . $response->getStatusCode() . "\n";
    echo "Response Content-Type: " . $response->headers->get('Content-Type') . "\n";
    echo "Response Content:\n" . $response->getContent() . "\n";
    
} catch (Exception $e) {
    echo "\nError: " . $e->getMessage() . "\n";
    echo "Stack Trace:\n" . $e->getTraceAsString() . "\n";
}

echo "\n=== Test Complete ===\n";
