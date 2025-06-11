<?php

require_once __DIR__ . '/vendor/autoload.php';

$app = require_once __DIR__ . '/bootstrap/app.php';
$app->make(\Illuminate\Contracts\Console\Kernel::class)->bootstrap();

// Create the symbolic link
if (!file_exists(public_path('storage'))) {
    echo "Creating symbolic link...\n";
    try {
        symlink(storage_path('app/public'), public_path('storage'));
        echo "Symbolic link created successfully.\n";
    } catch (Exception $e) {
        echo "Error creating symbolic link: " . $e->getMessage() . "\n";
    }
} else {
    echo "Symbolic link already exists.\n";
}

// Check if a file exists in the storage/app/public directory
$id = 1; // The ID of the record you're trying to view
try {
    $rumahtangga = \App\Models\Rumahtangga::findOrFail($id);
    
    echo "Found record with ID: $id\n";
    echo "Foto Rumah: " . $rumahtangga->foto_rumah . "\n";
    echo "Foto KTP: " . $rumahtangga->foto_ktp . "\n";
    echo "Foto KK: " . $rumahtangga->foto_kk . "\n\n";
    
    // Check if the files exist
    $fotoRumahPath = storage_path('app/public/' . $rumahtangga->foto_rumah);
    $fotoKtpPath = storage_path('app/public/' . $rumahtangga->foto_ktp);
    $fotoKkPath = storage_path('app/public/' . $rumahtangga->foto_kk);
    
    echo "Checking if files exist:\n";
    echo "Foto Rumah ($fotoRumahPath): " . (file_exists($fotoRumahPath) ? "Exists" : "Does not exist") . "\n";
    echo "Foto KTP ($fotoKtpPath): " . (file_exists($fotoKtpPath) ? "Exists" : "Does not exist") . "\n";
    echo "Foto KK ($fotoKkPath): " . (file_exists($fotoKkPath) ? "Exists" : "Does not exist") . "\n";
} catch (Exception $e) {
    echo "Error finding record: " . $e->getMessage() . "\n";
}
