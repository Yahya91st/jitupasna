<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class RekapSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->command->info('Starting Rekap seeder...');
        
        // Get all bencana IDs
        $bencanaIds = DB::table('bencana')->pluck('id');
        
        if ($bencanaIds->isEmpty()) {
            $this->command->warn('No bencana data found. Seeder aborted.');
            return;
        }
        
        $this->command->info("Found {$bencanaIds->count()} bencana records");
        
        // Define format tables that might exist
        $formatTables = [
            'format1_form4s',
            'format2_form4s', 
            'format3_form4s',
            'format4_form4s',
            'format5_form4s',
            'format6_form4s',
            'format7_form4s',
            'format8_form4s',
            'format9_form4s',
            'format10_form4s',
            'format11_form4s',
            'format12_form4s',
            'format13_form4s',
            'format14_form4s',
            'format15_form4s',
            'format16_form4s',
            'format17_form4s',
        ];
        
        // Check which tables exist
        $existingTables = [];
        foreach ($formatTables as $table) {
            if (Schema::hasTable($table)) {
                $existingTables[] = $table;
                $this->command->info("✓ Table {$table} exists");
            } else {
                $this->command->warn("✗ Table {$table} does not exist");
            }
        }
        
        if (empty($existingTables)) {
            $this->command->error('No format tables found. Seeder aborted.');
            return;
        }
        
        // Group format data by bencana_id and location (kampung + distrik)
        $rekapData = [];
        
        foreach ($existingTables as $table) {
            $formatNumber = (int) str_replace(['format', '_form4s'], '', $table);
            $formatColumn = "format{$formatNumber}_form4_id";
            
            $this->command->info("Processing {$table}...");
            
            $records = DB::table($table)->get();
            
            foreach ($records as $record) {
                $key = $record->bencana_id . '|' . ($record->nama_kampung ?? '') . '|' . ($record->nama_distrik ?? '');
                
                if (!isset($rekapData[$key])) {
                    $rekapData[$key] = [
                        'bencana_id' => $record->bencana_id,
                        'nama_kampung' => $record->nama_kampung ?? null,
                        'nama_distrik' => $record->nama_distrik ?? null,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ];
                    
                    // Initialize all format columns to null
                    for ($i = 1; $i <= 17; $i++) {
                        $rekapData[$key]["format{$i}_form4_id"] = null;
                    }
                }
                
                // Set the format ID for this record
                $rekapData[$key][$formatColumn] = $record->id;
            }
            
            $this->command->info("Processed " . $records->count() . " records from {$table}");
        }
        
        // Insert rekap data
        if (!empty($rekapData)) {
            $this->command->info("Inserting " . count($rekapData) . " rekap records...");
            
            $insertData = array_values($rekapData);
            
            // Insert in chunks to avoid memory issues
            $chunks = array_chunk($insertData, 100);
            
            foreach ($chunks as $chunk) {
                try {
                    DB::table('rekap')->insert($chunk);
                } catch (\Exception $e) {
                    $this->command->error("Error inserting chunk: " . $e->getMessage());
                    // Try inserting one by one to identify problematic records
                    foreach ($chunk as $record) {
                        try {
                            DB::table('rekap')->insert($record);
                        } catch (\Exception $ex) {
                            $this->command->warn("Skipped record for bencana_id {$record['bencana_id']}: " . $ex->getMessage());
                        }
                    }
                }
            }
            
            $this->command->info('✓ Rekap seeder completed successfully!');
            
            // Show summary
            $totalRekap = DB::table('rekap')->count();
            $this->command->info("Total rekap records created: {$totalRekap}");
            
            // Show format coverage
            for ($i = 1; $i <= 17; $i++) {
                $count = DB::table('rekap')->whereNotNull("format{$i}_form4_id")->count();
                if ($count > 0) {
                    $this->command->info("Format {$i}: {$count} records");
                }
            }
            
        } else {
            $this->command->warn('No data to insert into rekap table.');
        }
    }
}
