<?php

namespace App\Services;

use App\Models\Bencana;
use App\Models\Rekap;
use App\Models\Format1Form4;
use App\Models\Format5Form4;
use App\Models\Format6Form4;
use App\Models\Format7Form4;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class RekapAutoSyncService
{
    /**
     * Sync or create rekap record for a specific bencana and location
     */
    public function syncRekapForBencana($bencana_id, $nama_kampung = null, $nama_distrik = null)
    {
        try {
            DB::beginTransaction();

            // Find or create rekap record
            $rekap = Rekap::firstOrCreate([
                'bencana_id' => $bencana_id,
                'nama_kampung' => $nama_kampung,
                'nama_distrik' => $nama_distrik,
            ], [
                'status' => 'draft',
                'total_kerusakan' => 0,
                'total_kerugian' => 0,
            ]);

            // Sync all format data for this location
            $this->syncFormatData($rekap, $bencana_id, $nama_kampung, $nama_distrik);

            // Update calculated totals
            $rekap->updateCalculatedTotals();

            // Update status based on completion
            $rekap->updateStatusBasedOnCompletion();

            DB::commit();

            Log::info("Rekap synced successfully for bencana {$bencana_id}, kampung: {$nama_kampung}, distrik: {$nama_distrik}");

            return $rekap;

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error("Failed to sync rekap: " . $e->getMessage());
            throw $e;
        }
    }

    /**
     * Sync all format data for a rekap record
     */
    private function syncFormatData(Rekap $rekap, $bencana_id, $nama_kampung, $nama_distrik)
    {
        // Format 1 - Perumahan dan Pemukiman
        $format1 = Format1Form4::where('bencana_id', $bencana_id)
            ->where('nama_kampung', $nama_kampung)
            ->where('nama_distrik', $nama_distrik)
            ->first();
        $rekap->format1_form4_id = $format1->id ?? null;

        // Format 5 - Sektor Keagamaan
        $format5 = Format5Form4::where('bencana_id', $bencana_id)
            ->where('nama_kampung', $nama_kampung)
            ->where('nama_distrik', $nama_distrik)
            ->first();
        $rekap->format5_form4_id = $format5->id ?? null;

        // Format 6 - Air Minum & Sanitasi
        $format6 = Format6Form4::where('bencana_id', $bencana_id)
            ->where('nama_kampung', $nama_kampung)
            ->where('nama_distrik', $nama_distrik)
            ->first();
        $rekap->format6_form4_id = $format6->id ?? null;

        // Format 7 - Transportasi
        $format7 = Format7Form4::where('bencana_id', $bencana_id)
            ->where('nama_kampung', $nama_kampung)
            ->where('nama_distrik', $nama_distrik)
            ->first();
        $rekap->format7_form4_id = $format7->id ?? null;

        // Add more formats as they become available
        // Format 2-4, 8-17 will be added here when their models are created

        $rekap->save();
    }

    /**
     * Sync all rekap records for all bencana with cleanup
     * This will:
     * 1. Create rekap for new format data
     * 2. Update existing rekap
     * 3. Remove rekap records where format data no longer exists
     */
    public function syncAllRekap()
    {
        try {
            DB::beginTransaction();
            
            $bencanaList = Bencana::all();
            $syncedCount = 0;
            $deletedCount = 0;

            foreach ($bencanaList as $bencana) {
                // First, sync existing and new data
                $locations = $this->getUniqueLocationsForBencana($bencana->id);

                foreach ($locations as $location) {
                    $this->syncRekapForBencana(
                        $bencana->id,
                        $location['nama_kampung'],
                        $location['nama_distrik']
                    );
                    $syncedCount++;
                }

                // Then, cleanup orphaned rekap records for this bencana
                $deletedCount += $this->cleanupOrphanedRekap($bencana->id);
            }

            DB::commit();
            
            Log::info("Successfully synced {$syncedCount} rekap records and deleted {$deletedCount} orphaned records");
            return $syncedCount;

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error("Failed to sync all rekap: " . $e->getMessage());
            throw $e;
        }
    }

    /**
     * Sync rekap records for a specific bencana with cleanup
     */
    public function syncRekapForSpecificBencana($bencana_id)
    {
        try {
            DB::beginTransaction();
            
            $bencana = Bencana::findOrFail($bencana_id);
            $syncedCount = 0;
            $deletedCount = 0;

            // Get unique location combinations from all format tables for this bencana
            $locations = $this->getUniqueLocationsForBencana($bencana_id);

            foreach ($locations as $location) {
                $this->syncRekapForBencana(
                    $bencana_id,
                    $location['nama_kampung'],
                    $location['nama_distrik']
                );
                $syncedCount++;
            }

            // Cleanup orphaned rekap records for this bencana
            $deletedCount = $this->cleanupOrphanedRekap($bencana_id);

            DB::commit();
            
            Log::info("Successfully synced {$syncedCount} rekap records and deleted {$deletedCount} orphaned records for bencana {$bencana_id}");
            return [
                'synced' => $syncedCount,
                'deleted' => $deletedCount,
                'total' => $syncedCount
            ];

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error("Failed to sync rekap for bencana {$bencana_id}: " . $e->getMessage());
            throw $e;
        }
    }

    /**
     * Clean up orphaned rekap records where foreign key references no longer exist
     */
    private function cleanupOrphanedRekap($bencana_id)
    {
        $deletedCount = 0;
        
        // Get all rekap records for this bencana
        $rekapRecords = Rekap::where('bencana_id', $bencana_id)->get();
        
        foreach ($rekapRecords as $rekap) {
            $hasValidFormat = false;
            
            // Check Format1Form4
            if ($rekap->format1_form4_id) {
                $format1Exists = Format1Form4::where('id', $rekap->format1_form4_id)
                    ->where('bencana_id', $bencana_id)
                    ->where('nama_kampung', $rekap->nama_kampung)
                    ->where('nama_distrik', $rekap->nama_distrik)
                    ->exists();
                    
                if (!$format1Exists) {
                    $rekap->format1_form4_id = null;
                    Log::info("Removed invalid format1_form4_id {$rekap->format1_form4_id} from rekap {$rekap->id}");
                } else {
                    $hasValidFormat = true;
                }
            }
            
            // Check Format5Form4
            if ($rekap->format5_form4_id) {
                $format5Exists = Format5Form4::where('id', $rekap->format5_form4_id)
                    ->where('bencana_id', $bencana_id)
                    ->where('nama_kampung', $rekap->nama_kampung)
                    ->where('nama_distrik', $rekap->nama_distrik)
                    ->exists();
                    
                if (!$format5Exists) {
                    $rekap->format5_form4_id = null;
                    Log::info("Removed invalid format5_form4_id {$rekap->format5_form4_id} from rekap {$rekap->id}");
                } else {
                    $hasValidFormat = true;
                }
            }
            
            // Check Format6Form4
            if ($rekap->format6_form4_id) {
                $format6Exists = Format6Form4::where('id', $rekap->format6_form4_id)
                    ->where('bencana_id', $bencana_id)
                    ->where('nama_kampung', $rekap->nama_kampung)
                    ->where('nama_distrik', $rekap->nama_distrik)
                    ->exists();
                    
                if (!$format6Exists) {
                    $rekap->format6_form4_id = null;
                    Log::info("Removed invalid format6_form4_id {$rekap->format6_form4_id} from rekap {$rekap->id}");
                } else {
                    $hasValidFormat = true;
                }
            }
            
            // Check Format7Form4
            if ($rekap->format7_form4_id) {
                $format7Exists = Format7Form4::where('id', $rekap->format7_form4_id)
                    ->where('bencana_id', $bencana_id)
                    ->where('nama_kampung', $rekap->nama_kampung)
                    ->where('nama_distrik', $rekap->nama_distrik)
                    ->exists();
                    
                if (!$format7Exists) {
                    $rekap->format7_form4_id = null;
                    Log::info("Removed invalid format7_form4_id {$rekap->format7_form4_id} from rekap {$rekap->id}");
                } else {
                    $hasValidFormat = true;
                }
            }
            
            // Check if any format data exists for this location at all
            if (!$hasValidFormat) {
                $locationHasData = Format1Form4::where('bencana_id', $bencana_id)
                    ->where('nama_kampung', $rekap->nama_kampung)
                    ->where('nama_distrik', $rekap->nama_distrik)
                    ->exists() ||
                Format5Form4::where('bencana_id', $bencana_id)
                    ->where('nama_kampung', $rekap->nama_kampung)
                    ->where('nama_distrik', $rekap->nama_distrik)
                    ->exists() ||
                Format6Form4::where('bencana_id', $bencana_id)
                    ->where('nama_kampung', $rekap->nama_kampung)
                    ->where('nama_distrik', $rekap->nama_distrik)
                    ->exists() ||
                Format7Form4::where('bencana_id', $bencana_id)
                    ->where('nama_kampung', $rekap->nama_kampung)
                    ->where('nama_distrik', $rekap->nama_distrik)
                    ->exists();
                    
                if (!$locationHasData) {
                    // Delete rekap record as no format data exists for this location
                    Log::info("Deleting orphaned rekap {$rekap->id} for bencana {$bencana_id}, kampung: {$rekap->nama_kampung}, distrik: {$rekap->nama_distrik}");
                    $rekap->delete();
                    $deletedCount++;
                } else {
                    // Save the updated rekap (with nullified foreign keys)
                    $rekap->updateCalculatedTotals();
                    $rekap->updateStatusBasedOnCompletion();
                    $rekap->save();
                }
            } else {
                // Save the updated rekap
                $rekap->updateCalculatedTotals();
                $rekap->updateStatusBasedOnCompletion();
                $rekap->save();
            }
        }
        
        return $deletedCount;
    }

    /**
     * Get unique location combinations for a bencana from all format tables
     */
    private function getUniqueLocationsForBencana($bencana_id)
    {
        $locations = collect();

        // Get locations from Format 1
        $format1Locations = Format1Form4::where('bencana_id', $bencana_id)
            ->select('nama_kampung', 'nama_distrik')
            ->distinct()
            ->get();
        $locations = $locations->merge($format1Locations);

        // Get locations from Format 5
        $format5Locations = Format5Form4::where('bencana_id', $bencana_id)
            ->select('nama_kampung', 'nama_distrik')
            ->distinct()
            ->get();
        $locations = $locations->merge($format5Locations);

        // Get locations from Format 6
        $format6Locations = Format6Form4::where('bencana_id', $bencana_id)
            ->select('nama_kampung', 'nama_distrik')
            ->distinct()
            ->get();
        $locations = $locations->merge($format6Locations);

        // Get locations from Format 7
        $format7Locations = Format7Form4::where('bencana_id', $bencana_id)
            ->select('nama_kampung', 'nama_distrik')
            ->distinct()
            ->get();
        $locations = $locations->merge($format7Locations);

        // Remove duplicates and return
        return $locations->unique(function ($location) {
            return $location['nama_kampung'] . '|' . $location['nama_distrik'];
        })->values();
    }

    /**
     * Handle format data deletion - remove from rekap if no other formats exist
     */
    public function handleFormatDeletion($bencana_id, $nama_kampung, $nama_distrik, $formatType)
    {
        try {
            $rekap = Rekap::where('bencana_id', $bencana_id)
                ->where('nama_kampung', $nama_kampung)
                ->where('nama_distrik', $nama_distrik)
                ->first();

            if ($rekap) {
                // Remove the specific format reference
                $formatColumn = "format{$formatType}_form4_id";
                $rekap->$formatColumn = null;

                // Check if any formats are still linked
                $hasFormats = false;
                for ($i = 1; $i <= 17; $i++) {
                    $column = "format{$i}_form4_id";
                    if ($rekap->$column) {
                        $hasFormats = true;
                        break;
                    }
                }

                if ($hasFormats) {
                    // Update totals if there are still formats
                    $rekap->updateCalculatedTotals();
                    $rekap->updateStatusBasedOnCompletion();
                } else {
                    // Delete rekap if no formats are linked
                    $rekap->delete();
                    Log::info("Rekap deleted for bencana {$bencana_id} as no formats remain");
                }
            }

        } catch (\Exception $e) {
            Log::error("Failed to handle format deletion: " . $e->getMessage());
            throw $e;
        }
    }
}
