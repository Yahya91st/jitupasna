<?php

namespace App\Http\Controllers;

use App\Models\Rekap;
use App\Models\Bencana;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;

class RekapController extends Controller
{
    /**
     * Display a listing of rekap data
     */
    public function index(Request $request)
    {
        $query = Rekap::with('bencana');
        
        // Filter by bencana if specified
        if ($request->has('bencana_id') && $request->bencana_id) {
            $query->forBencana($request->bencana_id);
        }
        
        // Filter by status if specified
        if ($request->has('status') && $request->status) {
            $query->withStatus($request->status);
        }
        
        // Search by location
        if ($request->has('search') && $request->search) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('nama_kampung', 'like', "%{$search}%")
                  ->orWhere('nama_distrik', 'like', "%{$search}%");
            });
        }
        
        $rekaps = $query->latest()->paginate(15);
        $bencanas = Bencana::all();
        
        return view('rekap.index', compact('rekaps', 'bencanas'));
    }

    /**
     * Show detailed view of a specific rekap
     */
    public function show($id)
    {
        $rekap = Rekap::with('bencana')->findOrFail($id);
        $formats = $rekap->getFormatRelationships();
        
        return view('rekap.show', compact('rekap', 'formats'));
    }

    /**
     * Show dashboard with statistics
     */
    public function dashboard(Request $request)
    {
        $bencanaId = $request->input('bencana_id');
        
        $query = Rekap::with('bencana');
        
        if ($bencanaId) {
            $query->forBencana($bencanaId);
        }
        
        $rekaps = $query->get();
        
        // Calculate statistics
        $stats = [
            'total_rekap' => $rekaps->count(),
            'draft' => $rekaps->where('status', 'draft')->count(),
            'completed' => $rekaps->where('status', 'completed')->count(),
            'verified' => $rekaps->where('status', 'verified')->count(),
            'total_kerusakan' => $rekaps->sum('total_kerusakan'),
            'total_kerugian' => $rekaps->sum('total_kerugian'),
        ];
        
        // Format completion statistics
        $formatStats = [];
        for ($i = 1; $i <= 17; $i++) {
            $formatStats[$i] = $rekaps->filter(function($rekap) use ($i) {
                return $rekap->hasFormat($i);
            })->count();
        }
        
        $bencanas = Bencana::all();
        $selectedBencana = $bencanaId ? Bencana::find($bencanaId) : null;
        
        return view('rekap.dashboard', compact('stats', 'formatStats', 'bencanas', 'selectedBencana', 'rekaps'));
    }

    /**
     * Update status of rekap
     */
    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:draft,completed,verified'
        ]);
        
        $rekap = Rekap::findOrFail($id);
        $rekap->status = $request->status;
        $rekap->save();
        
        return response()->json([
            'success' => true,
            'message' => 'Status berhasil diperbarui'
        ]);
    }

    /**
     * Update calculated totals for a rekap
     */
    public function updateTotals($id)
    {
        $rekap = Rekap::findOrFail($id);
        $rekap->updateCalculatedTotals();
        
        return response()->json([
            'success' => true,
            'message' => 'Total berhasil diperbarui',
            'total_kerusakan' => $rekap->total_kerusakan,
            'total_kerugian' => $rekap->total_kerugian
        ]);
    }

    /**
     * Update calculated totals for all rekap
     */
    public function updateAllTotals(Request $request)
    {
        $bencanaId = $request->input('bencana_id');
        
        $query = Rekap::query();
        
        if ($bencanaId) {
            $query->forBencana($bencanaId);
        }
        
        $rekaps = $query->get();
        $updated = 0;
        
        foreach ($rekaps as $rekap) {
            $rekap->updateCalculatedTotals();
            $updated++;
        }
        
        return response()->json([
            'success' => true,
            'message' => "Berhasil memperbarui {$updated} rekap",
            'updated_count' => $updated
        ]);
    }

    /**
     * Generate comprehensive PDF report
     */
    public function generatePdf(Request $request)
    {
        $bencanaId = $request->input('bencana_id');
        $status = $request->input('status');
        
        $query = Rekap::with('bencana');
        
        if ($bencanaId) {
            $query->forBencana($bencanaId);
        }
        
        if ($status) {
            $query->withStatus($status);
        }
        
        $rekaps = $query->get();
        $bencana = $bencanaId ? Bencana::find($bencanaId) : null;
        
        // Calculate totals
        $totalKerusakan = $rekaps->sum('total_kerusakan');
        $totalKerugian = $rekaps->sum('total_kerugian');
        
        $pdf = Pdf::loadView('rekap.pdf', compact('rekaps', 'bencana', 'totalKerusakan', 'totalKerugian'));
        $pdf->setPaper('A4', 'landscape');
        
        $filename = 'Rekap_Kerusakan_' . ($bencana ? $bencana->Ref : 'All') . '_' . date('Y-m-d') . '.pdf';
        
        return $pdf->download($filename);
    }

    /**
     * Export data to Excel format (placeholder for future implementation)
     */
    public function exportExcel(Request $request)
    {
        // TODO: Implement Excel export using Laravel Excel package
        return response()->json([
            'message' => 'Excel export feature will be implemented later'
        ]);
    }

    /**
     * Get statistics for AJAX requests
     */
    public function getStats(Request $request)
    {
        $bencanaId = $request->input('bencana_id');
        
        $query = Rekap::query();
        
        if ($bencanaId) {
            $query->forBencana($bencanaId);
        }
        
        $rekaps = $query->get();
        
        $stats = [
            'total_rekap' => $rekaps->count(),
            'draft' => $rekaps->where('status', 'draft')->count(),
            'completed' => $rekaps->where('status', 'completed')->count(),
            'verified' => $rekaps->where('status', 'verified')->count(),
            'total_kerusakan' => number_format($rekaps->sum('total_kerusakan'), 2),
            'total_kerugian' => number_format($rekaps->sum('total_kerugian'), 2),
            'completion_percentage' => $rekaps->count() > 0 ? round($rekaps->avg(function($rekap) {
                return $rekap->getCompletionPercentage();
            }), 2) : 0
        ];
        
        return response()->json($stats);
    }

    /**
     * Bulk update status
     */
    public function bulkUpdateStatus(Request $request)
    {
        $request->validate([
            'ids' => 'required|array',
            'ids.*' => 'integer|exists:rekap,id',
            'status' => 'required|in:draft,completed,verified'
        ]);
        
        $updated = Rekap::whereIn('id', $request->ids)
                        ->update(['status' => $request->status]);
        
        return response()->json([
            'success' => true,
            'message' => "Berhasil memperbarui status {$updated} rekap",
            'updated_count' => $updated
        ]);
    }

    /**
     * Manually sync all rekap data with cleanup
     */
    public function syncAll(Request $request)
    {
        // Enhanced AJAX detection
        $isAjax = $request->ajax() || 
                  $request->wantsJson() || 
                  $request->expectsJson() ||
                  $request->header('X-Requested-With') === 'XMLHttpRequest' ||
                  $request->header('Content-Type') === 'application/json' ||
                  $request->header('Accept') === 'application/json';
        
        \Log::info('SyncAll method called', [
            'request_ajax' => $request->ajax(),
            'wants_json' => $request->wantsJson(),
            'expects_json' => $request->expectsJson(),
            'x_requested_with' => $request->header('X-Requested-With'),
            'content_type' => $request->header('Content-Type'),
            'accept' => $request->header('Accept'),
            'is_ajax_detected' => $isAjax,
            'all_headers' => $request->headers->all()
        ]);
        
        try {
            $rekapService = new \App\Services\RekapAutoSyncService();
            $bencanaId = $request->input('bencana_id');
            
            if ($bencanaId) {
                // Sync specific bencana
                $result = $rekapService->syncRekapForSpecificBencana($bencanaId);
                $syncedCount = $result['synced'];
                $deletedCount = $result['deleted'];
                
                \Log::info('Sync completed for specific bencana', [
                    'bencana_id' => $bencanaId,
                    'synced_count' => $syncedCount,
                    'deleted_count' => $deletedCount
                ]);
                
                $message = "Berhasil sinkronisasi {$syncedCount} data rekap untuk bencana #{$bencanaId}";
                if ($deletedCount > 0) {
                    $message .= " dan menghapus {$deletedCount} data orphan";
                }
            } else {
                // Sync all bencana
                $syncedCount = $rekapService->syncAllRekap();
                
                \Log::info('Sync completed successfully', ['synced_count' => $syncedCount]);
                
                $message = "Berhasil sinkronisasi {$syncedCount} data rekap untuk semua bencana";
            }
            
            // Use enhanced AJAX detection
            if ($isAjax) {
                $response = [
                    'success' => true,
                    'message' => $message,
                    'synced_count' => $syncedCount,
                    'deleted_count' => isset($deletedCount) ? $deletedCount : 0
                ];
                \Log::info('Returning AJAX response', $response);
                return response()->json($response);
            }
            
            return redirect()->back()->with('success', $message);
            
        } catch (\Exception $e) {
            \Log::error('Sync failed', ['error' => $e->getMessage(), 'trace' => $e->getTraceAsString()]);
            
            // Use enhanced AJAX detection
            if ($isAjax) {
                $response = [
                    'success' => false,
                    'message' => 'Gagal sinkronisasi data: ' . $e->getMessage()
                ];
                \Log::info('Returning AJAX error response', $response);
                return response()->json($response, 500);
            }
            
            return redirect()->back()->withErrors(['error' => 'Gagal sinkronisasi data: ' . $e->getMessage()]);
        }
    }
}
