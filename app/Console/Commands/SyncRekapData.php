<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\RekapAutoSyncService;

class SyncRekapData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'rekap:sync {--force : Force sync all data}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Synchronize Rekap data with all Format tables automatically';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Starting Rekap data synchronization...');
        
        try {
            $rekapService = new RekapAutoSyncService();
            
            if ($this->option('force')) {
                $this->warn('Force sync mode: This will recreate all rekap records');
                
                if ($this->confirm('Are you sure you want to proceed?')) {
                    // Clear existing rekap data
                    \App\Models\Rekap::truncate();
                    $this->info('Existing rekap data cleared.');
                }
            }
            
            $this->info('Syncing rekap data from all format tables...');
            $syncedCount = $rekapService->syncAllRekap();
            
            $this->info("✅ Successfully synced {$syncedCount} rekap records");
            
            // Show summary
            $this->table(['Metric', 'Count'], [
                ['Total Rekap Records', \App\Models\Rekap::count()],
                ['Draft Status', \App\Models\Rekap::where('status', 'draft')->count()],
                ['Completed Status', \App\Models\Rekap::where('status', 'completed')->count()],
                ['Verified Status', \App\Models\Rekap::where('status', 'verified')->count()],
                ['Total Kerusakan', 'Rp ' . number_format(\App\Models\Rekap::sum('total_kerusakan'), 0, ',', '.')],
                ['Total Kerugian', 'Rp ' . number_format(\App\Models\Rekap::sum('total_kerugian'), 0, ',', '.')],
            ]);
            
        } catch (\Exception $e) {
            $this->error('❌ Failed to sync rekap data: ' . $e->getMessage());
            return 1;
        }
        
        return 0;
    }
}
