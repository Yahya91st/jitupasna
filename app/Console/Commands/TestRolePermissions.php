<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Spatie\Permission\Models\Role;

class TestRolePermissions extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'roles:test';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Test role permissions setup for Super Admin, Admin, and User roles';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->info('==== Testing Super Admin Permissions ====');
        $superAdmin = User::where('email', 'super-admin@example.com')->first();

        if (!$superAdmin) {
            $this->error("Super Admin user not found. Please run the RoleSeeder first.");
        } else {
            $this->info("Super Admin Permissions:");
            foreach ($superAdmin->getAllPermissions() as $permission) {
                $this->line("- " . $permission->name);
            }
            $this->line("");
        }

        $this->info('==== Testing Admin Permissions ====');
        $admin = User::where('email', 'admin@example.com')->first();

        if (!$admin) {
            $this->error("Admin user not found. Please run the RoleSeeder first.");
        } else {
            $this->info("Admin Permissions:");
            foreach ($admin->getAllPermissions() as $permission) {
                $this->line("- " . $permission->name);
            }
            $this->line("");
        }

        $this->info('==== Testing Regular User Permissions ====');
        $user = User::where('email', 'user@example.com')->first();

        if (!$user) {
            $this->error("Regular user not found. Please run the RoleSeeder first.");
        } else {
            $this->info("User Permissions:");
            foreach ($user->getAllPermissions() as $permission) {
                $this->line("- " . $permission->name);
            }
            $this->line("");
        }

        $this->info('==== Available Roles ====');
        $roles = Role::all();
        foreach ($roles as $role) {
            $this->info("Role: " . $role->name);
            $this->info("Permissions:");
            foreach ($role->permissions as $permission) {
                $this->line("- " . $permission->name);
            }
            $this->line("");
        }

        $this->info('==== Test Complete ====');
        return 0;
    }
}
