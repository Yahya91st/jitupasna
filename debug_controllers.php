<?php

// This is a simple debug file to help diagnose controller loading issues
// Add this at the very beginning of your public/index.php file after the autoloader is loaded

// Get the full URL being requested
$requestedUrl = $_SERVER['REQUEST_URI'];
$requestedMethod = $_SERVER['REQUEST_METHOD'];

// Write to a debug log file
file_put_contents(
    __DIR__ . '/controller_debug.log', 
    date('Y-m-d H:i:s') . " - Requested: $requestedMethod $requestedUrl\n",
    FILE_APPEND
);

// Log all registered controllers
$controllers = array_filter(get_declared_classes(), function($className) {
    return strpos($className, 'App\\Http\\Controllers\\') === 0;
});

file_put_contents(
    __DIR__ . '/controller_debug.log',
    date('Y-m-d H:i:s') . " - Registered controllers: " . implode(', ', $controllers) . "\n",
    FILE_APPEND
);

// Check for the specific controllers we're interested in
$pendataanExists = class_exists('App\\Http\\Controllers\\PendataanController');
$form3Exists = class_exists('App\\Http\\Controllers\\Form3Controller');

file_put_contents(
    __DIR__ . '/controller_debug.log',
    date('Y-m-d H:i:s') . " - PendataanController exists: " . ($pendataanExists ? 'Yes' : 'No') . "\n",
    FILE_APPEND
);

file_put_contents(
    __DIR__ . '/controller_debug.log',
    date('Y-m-d H:i:s') . " - Form3Controller exists: " . ($form3Exists ? 'Yes' : 'No') . "\n",
    FILE_APPEND
);

// Check if any class is aliased or improperly registered
@include_once __DIR__ . '/app/Http/Controllers/Form3Controller.php';

file_put_contents(
    __DIR__ . '/controller_debug.log',
    date('Y-m-d H:i:s') . " - Form3Controller after include: " . (class_exists('App\\Http\\Controllers\\Form3Controller') ? 'Yes' : 'No') . "\n",
    FILE_APPEND
);

// Continue normal execution
