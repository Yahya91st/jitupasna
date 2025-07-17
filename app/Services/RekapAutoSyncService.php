<?php

namespace App\Services;

use App\Models\Bencana;
use App\Models\Rekap;
use App\Models\Format1Form4;
use App\Models\Format2Form4;
use App\Models\Format3Form4;
use App\Models\Format4Form4;
use App\Models\Format5Form4;
use App\Models\Format6Form4;
use App\Models\Format7Form4;
use App\Models\Format8Form4;
use App\Models\Format9Form4;
use App\Models\Format10Form4;
use App\Models\Format11Form4;
use App\Models\Format12Form4;
use App\Models\Format13Form4;
use App\Models\Format14Form4;
use App\Models\Format15Form4;
use App\Models\Format16Form4;
use App\Models\Format17Form4;
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

        // Format 2 - Pendidikan
        $format2 = Format2Form4::where('bencana_id', $bencana_id)
            ->where('nama_kampung', $nama_kampung)
            ->where('nama_distrik', $nama_distrik)
            ->first();
        $rekap->format2_form4_id = $format2->id ?? null;

        // Format 3
        $format3 = Format3Form4::where('bencana_id', $bencana_id)
            ->where('nama_kampung', $nama_kampung)
            ->where('nama_distrik', $nama_distrik)
            ->first();
        $rekap->format3_form4_id = $format3->id ?? null;

        // Format 4
        $format4 = Format4Form4::where('bencana_id', $bencana_id)
            ->where('nama_kampung', $nama_kampung)
            ->where('nama_distrik', $nama_distrik)
            ->first();
        $rekap->format4_form4_id = $format4->id ?? null;

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

        // Format 8
        $format8 = Format8Form4::where('bencana_id', $bencana_id)
            ->where('nama_kampung', $nama_kampung)
            ->where('nama_distrik', $nama_distrik)
            ->first();
        $rekap->format8_form4_id = $format8->id ?? null;

        // Format 9
        $format9 = Format9Form4::where('bencana_id', $bencana_id)
            ->where('nama_kampung', $nama_kampung)
            ->where('nama_distrik', $nama_distrik)
            ->first();
        $rekap->format9_form4_id = $format9->id ?? null;

        // Format 10
        $format10 = Format10Form4::where('bencana_id', $bencana_id)
            ->where('nama_kampung', $nama_kampung)
            ->where('nama_distrik', $nama_distrik)
            ->first();
        $rekap->format10_form4_id = $format10->id ?? null;

        // Format 11
        $format11 = Format11Form4::where('bencana_id', $bencana_id)
            ->where('nama_kampung', $nama_kampung)
            ->where('nama_distrik', $nama_distrik)
            ->first();
        $rekap->format11_form4_id = $format11->id ?? null;

        // Format 12
        $format12 = Format12Form4::where('bencana_id', $bencana_id)
            ->where('nama_kampung', $nama_kampung)
            ->where('nama_distrik', $nama_distrik)
            ->first();
        $rekap->format12_form4_id = $format12->id ?? null;

        // Format 13
        $format13 = Format13Form4::where('bencana_id', $bencana_id)
            ->where('nama_kampung', $nama_kampung)
            ->where('nama_distrik', $nama_distrik)
            ->first();
        $rekap->format13_form4_id = $format13->id ?? null;

        // Format 14
        $format14 = Format14Form4::where('bencana_id', $bencana_id)
            ->where('nama_kampung', $nama_kampung)
            ->where('nama_distrik', $nama_distrik)
            ->first();
        $rekap->format14_form4_id = $format14->id ?? null;

        // Format 15
        $format15 = Format15Form4::where('bencana_id', $bencana_id)
            ->where('nama_kampung', $nama_kampung)
            ->where('nama_distrik', $nama_distrik)
            ->first();
        $rekap->format15_form4_id = $format15->id ?? null;

        // Format 16
        $format16 = Format16Form4::where('bencana_id', $bencana_id)
            ->where('nama_kampung', $nama_kampung)
            ->where('nama_distrik', $nama_distrik)
            ->first();
        $rekap->format16_form4_id = $format16->id ?? null;

        // Format 17
        $format17 = Format17Form4::where('bencana_id', $bencana_id)
            ->where('nama_kampung', $nama_kampung)
            ->where('nama_distrik', $nama_distrik)
            ->first();
        $rekap->format17_form4_id = $format17->id ?? null;

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

            // Check Format2Form4
            if ($rekap->format2_form4_id) {
                $format2Exists = Format2Form4::where('id', $rekap->format2_form4_id)
                    ->where('bencana_id', $bencana_id)
                    ->where('nama_kampung', $rekap->nama_kampung)
                    ->where('nama_distrik', $rekap->nama_distrik)
                    ->exists();
                    
                if (!$format2Exists) {
                    $rekap->format2_form4_id = null;
                    Log::info("Removed invalid format2_form4_id {$rekap->format2_form4_id} from rekap {$rekap->id}");
                } else {
                    $hasValidFormat = true;
                }
            }

            // Check Format3Form4
            if ($rekap->format3_form4_id) {
                $format3Exists = Format3Form4::where('id', $rekap->format3_form4_id)
                    ->where('bencana_id', $bencana_id)
                    ->where('nama_kampung', $rekap->nama_kampung)
                    ->where('nama_distrik', $rekap->nama_distrik)
                    ->exists();
                    
                if (!$format3Exists) {
                    $rekap->format3_form4_id = null;
                    Log::info("Removed invalid format3_form4_id {$rekap->format3_form4_id} from rekap {$rekap->id}");
                } else {
                    $hasValidFormat = true;
                }
            }

            // Check Format4Form4
            if ($rekap->format4_form4_id) {
                $format4Exists = Format4Form4::where('id', $rekap->format4_form4_id)
                    ->where('bencana_id', $bencana_id)
                    ->where('nama_kampung', $rekap->nama_kampung)
                    ->where('nama_distrik', $rekap->nama_distrik)
                    ->exists();
                    
                if (!$format4Exists) {
                    $rekap->format4_form4_id = null;
                    Log::info("Removed invalid format4_form4_id {$rekap->format4_form4_id} from rekap {$rekap->id}");
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

            // Check Format8Form4
            if ($rekap->format8_form4_id) {
                $format8Exists = Format8Form4::where('id', $rekap->format8_form4_id)
                    ->where('bencana_id', $bencana_id)
                    ->where('nama_kampung', $rekap->nama_kampung)
                    ->where('nama_distrik', $rekap->nama_distrik)
                    ->exists();
                    
                if (!$format8Exists) {
                    $rekap->format8_form4_id = null;
                    Log::info("Removed invalid format8_form4_id {$rekap->format8_form4_id} from rekap {$rekap->id}");
                } else {
                    $hasValidFormat = true;
                }
            }

            // Check Format9Form4
            if ($rekap->format9_form4_id) {
                $format9Exists = Format9Form4::where('id', $rekap->format9_form4_id)
                    ->where('bencana_id', $bencana_id)
                    ->where('nama_kampung', $rekap->nama_kampung)
                    ->where('nama_distrik', $rekap->nama_distrik)
                    ->exists();
                    
                if (!$format9Exists) {
                    $rekap->format9_form4_id = null;
                    Log::info("Removed invalid format9_form4_id {$rekap->format9_form4_id} from rekap {$rekap->id}");
                } else {
                    $hasValidFormat = true;
                }
            }

            // Check Format10Form4
            if ($rekap->format10_form4_id) {
                $format10Exists = Format10Form4::where('id', $rekap->format10_form4_id)
                    ->where('bencana_id', $bencana_id)
                    ->where('nama_kampung', $rekap->nama_kampung)
                    ->where('nama_distrik', $rekap->nama_distrik)
                    ->exists();
                    
                if (!$format10Exists) {
                    $rekap->format10_form4_id = null;
                    Log::info("Removed invalid format10_form4_id {$rekap->format10_form4_id} from rekap {$rekap->id}");
                } else {
                    $hasValidFormat = true;
                }
            }

            // Check Format11Form4
            if ($rekap->format11_form4_id) {
                $format11Exists = Format11Form4::where('id', $rekap->format11_form4_id)
                    ->where('bencana_id', $bencana_id)
                    ->where('nama_kampung', $rekap->nama_kampung)
                    ->where('nama_distrik', $rekap->nama_distrik)
                    ->exists();
                    
                if (!$format11Exists) {
                    $rekap->format11_form4_id = null;
                    Log::info("Removed invalid format11_form4_id {$rekap->format11_form4_id} from rekap {$rekap->id}");
                } else {
                    $hasValidFormat = true;
                }
            }

            // Check Format12Form4
            if ($rekap->format12_form4_id) {
                $format12Exists = Format12Form4::where('id', $rekap->format12_form4_id)
                    ->where('bencana_id', $bencana_id)
                    ->where('nama_kampung', $rekap->nama_kampung)
                    ->where('nama_distrik', $rekap->nama_distrik)
                    ->exists();
                    
                if (!$format12Exists) {
                    $rekap->format12_form4_id = null;
                    Log::info("Removed invalid format12_form4_id {$rekap->format12_form4_id} from rekap {$rekap->id}");
                } else {
                    $hasValidFormat = true;
                }
            }

            // Check Format13Form4
            if ($rekap->format13_form4_id) {
                $format13Exists = Format13Form4::where('id', $rekap->format13_form4_id)
                    ->where('bencana_id', $bencana_id)
                    ->where('nama_kampung', $rekap->nama_kampung)
                    ->where('nama_distrik', $rekap->nama_distrik)
                    ->exists();
                    
                if (!$format13Exists) {
                    $rekap->format13_form4_id = null;
                    Log::info("Removed invalid format13_form4_id {$rekap->format13_form4_id} from rekap {$rekap->id}");
                } else {
                    $hasValidFormat = true;
                }
            }

            // Check Format14Form4
            if ($rekap->format14_form4_id) {
                $format14Exists = Format14Form4::where('id', $rekap->format14_form4_id)
                    ->where('bencana_id', $bencana_id)
                    ->where('nama_kampung', $rekap->nama_kampung)
                    ->where('nama_distrik', $rekap->nama_distrik)
                    ->exists();
                    
                if (!$format14Exists) {
                    $rekap->format14_form4_id = null;
                    Log::info("Removed invalid format14_form4_id {$rekap->format14_form4_id} from rekap {$rekap->id}");
                } else {
                    $hasValidFormat = true;
                }
            }

            // Check Format15Form4
            if ($rekap->format15_form4_id) {
                $format15Exists = Format15Form4::where('id', $rekap->format15_form4_id)
                    ->where('bencana_id', $bencana_id)
                    ->where('nama_kampung', $rekap->nama_kampung)
                    ->where('nama_distrik', $rekap->nama_distrik)
                    ->exists();
                    
                if (!$format15Exists) {
                    $rekap->format15_form4_id = null;
                    Log::info("Removed invalid format15_form4_id {$rekap->format15_form4_id} from rekap {$rekap->id}");
                } else {
                    $hasValidFormat = true;
                }
            }

            // Check Format16Form4
            if ($rekap->format16_form4_id) {
                $format16Exists = Format16Form4::where('id', $rekap->format16_form4_id)
                    ->where('bencana_id', $bencana_id)
                    ->where('nama_kampung', $rekap->nama_kampung)
                    ->where('nama_distrik', $rekap->nama_distrik)
                    ->exists();
                    
                if (!$format16Exists) {
                    $rekap->format16_form4_id = null;
                    Log::info("Removed invalid format16_form4_id {$rekap->format16_form4_id} from rekap {$rekap->id}");
                } else {
                    $hasValidFormat = true;
                }
            }

            // Check Format17Form4
            if ($rekap->format17_form4_id) {
                $format17Exists = Format17Form4::where('id', $rekap->format17_form4_id)
                    ->where('bencana_id', $bencana_id)
                    ->where('nama_kampung', $rekap->nama_kampung)
                    ->where('nama_distrik', $rekap->nama_distrik)
                    ->exists();
                    
                if (!$format17Exists) {
                    $rekap->format17_form4_id = null;
                    Log::info("Removed invalid format17_form4_id {$rekap->format17_form4_id} from rekap {$rekap->id}");
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
                Format2Form4::where('bencana_id', $bencana_id)
                    ->where('nama_kampung', $rekap->nama_kampung)
                    ->where('nama_distrik', $rekap->nama_distrik)
                    ->exists() ||
                Format3Form4::where('bencana_id', $bencana_id)
                    ->where('nama_kampung', $rekap->nama_kampung)
                    ->where('nama_distrik', $rekap->nama_distrik)
                    ->exists() ||
                Format4Form4::where('bencana_id', $bencana_id)
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
                    ->exists() ||
                Format8Form4::where('bencana_id', $bencana_id)
                    ->where('nama_kampung', $rekap->nama_kampung)
                    ->where('nama_distrik', $rekap->nama_distrik)
                    ->exists() ||
                Format9Form4::where('bencana_id', $bencana_id)
                    ->where('nama_kampung', $rekap->nama_kampung)
                    ->where('nama_distrik', $rekap->nama_distrik)
                    ->exists() ||
                Format10Form4::where('bencana_id', $bencana_id)
                    ->where('nama_kampung', $rekap->nama_kampung)
                    ->where('nama_distrik', $rekap->nama_distrik)
                    ->exists() ||
                Format11Form4::where('bencana_id', $bencana_id)
                    ->where('nama_kampung', $rekap->nama_kampung)
                    ->where('nama_distrik', $rekap->nama_distrik)
                    ->exists() ||
                Format12Form4::where('bencana_id', $bencana_id)
                    ->where('nama_kampung', $rekap->nama_kampung)
                    ->where('nama_distrik', $rekap->nama_distrik)
                    ->exists() ||
                Format13Form4::where('bencana_id', $bencana_id)
                    ->where('nama_kampung', $rekap->nama_kampung)
                    ->where('nama_distrik', $rekap->nama_distrik)
                    ->exists() ||
                Format14Form4::where('bencana_id', $bencana_id)
                    ->where('nama_kampung', $rekap->nama_kampung)
                    ->where('nama_distrik', $rekap->nama_distrik)
                    ->exists() ||
                Format15Form4::where('bencana_id', $bencana_id)
                    ->where('nama_kampung', $rekap->nama_kampung)
                    ->where('nama_distrik', $rekap->nama_distrik)
                    ->exists() ||
                Format16Form4::where('bencana_id', $bencana_id)
                    ->where('nama_kampung', $rekap->nama_kampung)
                    ->where('nama_distrik', $rekap->nama_distrik)
                    ->exists() ||
                Format17Form4::where('bencana_id', $bencana_id)
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

        // Get locations from Format 2
        $format2Locations = Format2Form4::where('bencana_id', $bencana_id)
            ->select('nama_kampung', 'nama_distrik')
            ->distinct()
            ->get();
        $locations = $locations->merge($format2Locations);

        // Get locations from Format 3
        $format3Locations = Format3Form4::where('bencana_id', $bencana_id)
            ->select('nama_kampung', 'nama_distrik')
            ->distinct()
            ->get();
        $locations = $locations->merge($format3Locations);

        // Get locations from Format 4
        $format4Locations = Format4Form4::where('bencana_id', $bencana_id)
            ->select('nama_kampung', 'nama_distrik')
            ->distinct()
            ->get();
        $locations = $locations->merge($format4Locations);

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

        // Get locations from Format 8
        $format8Locations = Format8Form4::where('bencana_id', $bencana_id)
            ->select('nama_kampung', 'nama_distrik')
            ->distinct()
            ->get();
        $locations = $locations->merge($format8Locations);

        // Get locations from Format 9
        $format9Locations = Format9Form4::where('bencana_id', $bencana_id)
            ->select('nama_kampung', 'nama_distrik')
            ->distinct()
            ->get();
        $locations = $locations->merge($format9Locations);

        // Get locations from Format 10
        $format10Locations = Format10Form4::where('bencana_id', $bencana_id)
            ->select('nama_kampung', 'nama_distrik')
            ->distinct()
            ->get();
        $locations = $locations->merge($format10Locations);

        // Get locations from Format 11
        $format11Locations = Format11Form4::where('bencana_id', $bencana_id)
            ->select('nama_kampung', 'nama_distrik')
            ->distinct()
            ->get();
        $locations = $locations->merge($format11Locations);

        // Get locations from Format 12
        $format12Locations = Format12Form4::where('bencana_id', $bencana_id)
            ->select('nama_kampung', 'nama_distrik')
            ->distinct()
            ->get();
        $locations = $locations->merge($format12Locations);

        // Get locations from Format 13
        $format13Locations = Format13Form4::where('bencana_id', $bencana_id)
            ->select('nama_kampung', 'nama_distrik')
            ->distinct()
            ->get();
        $locations = $locations->merge($format13Locations);

        // Get locations from Format 14
        $format14Locations = Format14Form4::where('bencana_id', $bencana_id)
            ->select('nama_kampung', 'nama_distrik')
            ->distinct()
            ->get();
        $locations = $locations->merge($format14Locations);

        // Get locations from Format 15
        $format15Locations = Format15Form4::where('bencana_id', $bencana_id)
            ->select('nama_kampung', 'nama_distrik')
            ->distinct()
            ->get();
        $locations = $locations->merge($format15Locations);

        // Get locations from Format 16
        $format16Locations = Format16Form4::where('bencana_id', $bencana_id)
            ->select('nama_kampung', 'nama_distrik')
            ->distinct()
            ->get();
        $locations = $locations->merge($format16Locations);

        // Get locations from Format 17
        $format17Locations = Format17Form4::where('bencana_id', $bencana_id)
            ->select('nama_kampung', 'nama_distrik')
            ->distinct()
            ->get();
        $locations = $locations->merge($format17Locations);

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
