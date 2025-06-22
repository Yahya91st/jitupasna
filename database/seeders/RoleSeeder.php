<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */    public function run()
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Delete existing roles and permissions
        Role::query()->delete();
        Permission::query()->delete();        // Create permissions
        Permission::create(['name' => 'manage categories']);
        Permission::create(['name' => 'view forms']);
        Permission::create(['name' => 'edit forms']);
        Permission::create(['name' => 'manage disasters']);
        Permission::create(['name' => 'manage users']);
        Permission::create(['name' => 'manage admins']);

        // Create Super Admin role with all permissions
        $superAdminRole = Role::create(['name' => 'super-admin']);
        $superAdminRole->givePermissionTo([
            'manage categories',
            'view forms',
            'edit forms',
            'manage disasters',
            'manage admins'
        ]);

        // Create roles and assign permissions
        $adminRole = Role::create(['name' => 'admin']);
        $adminRole->givePermissionTo([
            'manage categories',
            'view forms',
            'edit forms',
            'manage disasters',
            'manage users'
        ]);

        $userRole = Role::create(['name' => 'user']);
        $userRole->givePermissionTo([
            'view forms',
            'edit forms'
        ]);        // Check if super admin user exists
        $superAdminUser = User::where('email', 'super-admin@example.com')->first();
        
        if (!$superAdminUser) {
            // Create super admin user
            $superAdmin = User::create([
                'name' => 'Super Admin',
                'email' => 'super-admin@example.com',
                'password' => bcrypt('password'),
            ]);
            $superAdmin->assignRole('super-admin');
        } else {
            // Ensure existing super admin has the super-admin role
            $superAdminUser->syncRoles(['super-admin']);
        }

        // Check if admin user exists
        $adminUser = User::where('email', 'admin@example.com')->first();
        
        if (!$adminUser) {
            // Create admin user
            $admin = User::create([
                'name' => 'Admin',
                'email' => 'admin@example.com',
                'password' => bcrypt('password'),
            ]);
            $admin->assignRole('admin');
        } else {
            // Ensure existing admin has the admin role
            $adminUser->syncRoles(['admin']);
        }

        // Check if regular user exists
        $regularUser = User::where('email', 'user@example.com')->first();
        
        if (!$regularUser) {
            // Create regular user
            $user = User::create([
                'name' => 'User',
                'email' => 'user@example.com',
                'password' => bcrypt('password'),
            ]);
            $user->assignRole('user');
        } else {
            // Ensure existing user has the user role
            $regularUser->syncRoles(['user']);
        }
    }
}
