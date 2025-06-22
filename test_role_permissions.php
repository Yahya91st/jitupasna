<?php

require __DIR__.'/vendor/autoload.php';
require __DIR__.'/bootstrap/app.php';

use App\Models\User;
use Spatie\Permission\Models\Role;

// Test permission for Super Admin role
echo "==== Testing Super Admin Permissions ====\n";
$superAdmin = User::where('email', 'super-admin@example.com')->first();

if (!$superAdmin) {
    echo "Super Admin user not found. Please run the RoleSeeder first.\n";
} else {
    echo "Super Admin Permissions:\n";
    foreach ($superAdmin->getAllPermissions() as $permission) {
        echo "- " . $permission->name . "\n";
    }
    echo "\n";
}

// Test permission for Admin role
echo "==== Testing Admin Permissions ====\n";
$admin = User::where('email', 'admin@example.com')->first();

if (!$admin) {
    echo "Admin user not found. Please run the RoleSeeder first.\n";
} else {
    echo "Admin Permissions:\n";
    foreach ($admin->getAllPermissions() as $permission) {
        echo "- " . $permission->name . "\n";
    }
    echo "\n";
}

// Test permission for regular User role
echo "==== Testing Regular User Permissions ====\n";
$user = User::where('email', 'user@example.com')->first();

if (!$user) {
    echo "Regular user not found. Please run the RoleSeeder first.\n";
} else {
    echo "User Permissions:\n";
    foreach ($user->getAllPermissions() as $permission) {
        echo "- " . $permission->name . "\n";
    }
    echo "\n";
}

echo "==== Available Roles ====\n";
$roles = Role::all();
foreach ($roles as $role) {
    echo "Role: " . $role->name . "\n";
    echo "Permissions:\n";
    foreach ($role->permissions as $permission) {
        echo "- " . $permission->name . "\n";
    }
    echo "\n";
}

echo "==== Test Complete ====\n";
