<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class RefreshRolesCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'roles:refresh';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Refresh all roles and permissions, and create default admin and user accounts';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Refreshing roles and permissions...');
        
        // Run the role seeder
        Artisan::call('db:seed', ['--class' => 'RoleSeeder']);
        
        $this->info('Roles and permissions have been refreshed!');
        
        $this->info('Admin user created with email: admin@example.com and password: password');
        $this->info('Regular user created with email: user@example.com and password: password');
        
        return Command::SUCCESS;
    }
}
