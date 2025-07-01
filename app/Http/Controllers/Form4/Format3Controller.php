<?php

namespace App\Http\Controllers\Form4;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Bencana;
use App\Models\Format3Form4;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;

class Format3Controller extends Controller
{
    /**
     * Display Format 3 form for Health sector data collection
     */
    public function index(Request $request)
    {
        $bencana_id = $request->input('bencana_id');
        
        // Redirect to bencana selection if no bencana_id is provided
        if (!$bencana_id) {
            return redirect()->route('bencana.index', ['source' => 'forms']);
        }
        
        // Get bencana details
        $bencana = Bencana::findOrFail($bencana_id);
        
        return view('forms.form4.format3.format3form4', compact('bencana'));
    }

    /**
     * Store format3 form data for Health sector
     */
    public function store(Request $request)
    {
        try {
            DB::beginTransaction();

            // Validate the request
            $validated = $request->validate([
                'bencana_id' => 'required|exists:bencana,id',
                'nama_kampung' => 'required|string',
                'nama_distrik' => 'required|string',
                // Health sector specific fields - customize based on actual form
                'puskesmas_hancur_total' => 'nullable|integer',
                'puskesmas_rusak_berat' => 'nullable|integer',
                'puskesmas_rusak_sedang' => 'nullable|integer',
                'puskesmas_rusak_ringan' => 'nullable|integer',
                'harga_satuan_puskesmas' => 'nullable|numeric',
                'polindes_hancur_total' => 'nullable|integer',
                'polindes_rusak_berat' => 'nullable|integer',
                'polindes_rusak_sedang' => 'nullable|integer',
                'polindes_rusak_ringan' => 'nullable|integer',
                'harga_satuan_polindes' => 'nullable|numeric',
                'posyandu_hancur_total' => 'nullable|integer',
                'posyandu_rusak_berat' => 'nullable|integer',
                'posyandu_rusak_sedang' => 'nullable|integer',
                'posyandu_rusak_ringan' => 'nullable|integer',
                'harga_satuan_posyandu' => 'nullable|numeric',
                'obat_obatan_rusak' => 'nullable|numeric',
                'harga_satuan_obat' => 'nullable|numeric',
                'peralatan_medis_rusak' => 'nullable|integer',
                'harga_satuan_alat_medis' => 'nullable|numeric',
            ]);

            // Create new form data
            $formKesehatan = Format3Form4::create($validated);

            DB::commit();

            // Return success response for AJAX or redirect for regular form
            if ($request->ajax()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Data berhasil disimpan',
                    'data' => $formKesehatan
                ]);
            }

            return redirect()->back()->with('success', 'Data berhasil disimpan');

        } catch (\Exception $e) {
            DB::rollBack();
            
            if ($request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Terjadi kesalahan: ' . $e->getMessage()
                ], 500);
            }

            return redirect()->back()
                ->withInput()
                ->withErrors(['error' => 'Terjadi kesalahan saat menyimpan data. ' . $e->getMessage()]);
        }
    }

    /**
     * Show a specific form data
     */
    public function show($id)
    {
        $formKesehatan = Format3Form4::with('bencana')->findOrFail($id);
        $bencana = $formKesehatan->bencana;
        
        return view('forms.form4.format3.show-format3', compact('formKesehatan', 'bencana'));
    }

    /**
     * List all entries for this format
     */
    public function list(Request $request)
    {
        $bencana_id = $request->input('bencana_id');
        
        // Redirect to bencana selection if no bencana_id is provided
        if (!$bencana_id) {
            return redirect()->route('bencana.index', ['source' => 'forms']);
        }
        
        // Get bencana details
        $bencana = Bencana::findOrFail($bencana_id);
        
        // Get form data for this disaster
        $formData = Format3Form4::where('bencana_id', $bencana_id)->get();
        
        return view('forms.form4.format3.format3list', compact('bencana', 'formData'));
    }

    /**
     * Generate PDF for a specific form data
     */
    public function generatePdf($id)
    {
        $formKesehatan = Format3Form4::with('bencana')->findOrFail($id);
        $bencana = $formKesehatan->bencana;
        
        $pdf = Pdf::loadView('forms.form4.format3.pdf', compact('formKesehatan', 'bencana'));
        $pdf->setPaper('A4', 'landscape');
        
        return $pdf->download('Format3_Kesehatan_' . $formKesehatan->nama_kampung . '.pdf');
    }

    /**
     * Preview PDF for a specific form data
     */
    public function previewPdf($id)
    {
        $formKesehatan = Format3Form4::with('bencana')->findOrFail($id);
        $bencana = $formKesehatan->bencana;
        
        $pdf = Pdf::loadView('forms.form4.format3.pdf', compact('formKesehatan', 'bencana'));
        $pdf->setPaper('A4', 'landscape');
        
        return $pdf->stream('Format3_Kesehatan_' . $formKesehatan->nama_kampung . '.pdf');
    }
}
