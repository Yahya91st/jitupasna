<?php

namespace App\Http\Controllers\Form4;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Bencana;
use App\Models\Format4Form4;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;

class Format4Controller extends Controller
{
    /**
     * Display Format 4 form for Social Protection sector data collection
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
        
        return view('forms.form4.format4.format4form4', compact('bencana'));
    }

    /**
     * Store format4 form data for Social Protection sector
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
                // Social Protection sector specific fields - customize based on actual form
                'panti_asuhan_hancur_total' => 'nullable|integer',
                'panti_asuhan_rusak_berat' => 'nullable|integer',
                'panti_asuhan_rusak_sedang' => 'nullable|integer',
                'panti_asuhan_rusak_ringan' => 'nullable|integer',
                'harga_satuan_panti_asuhan' => 'nullable|numeric',
                'panti_jompo_hancur_total' => 'nullable|integer',
                'panti_jompo_rusak_berat' => 'nullable|integer',
                'panti_jompo_rusak_sedang' => 'nullable|integer',
                'panti_jompo_rusak_ringan' => 'nullable|integer',
                'harga_satuan_panti_jompo' => 'nullable|numeric',
                'balai_sosial_hancur_total' => 'nullable|integer',
                'balai_sosial_rusak_berat' => 'nullable|integer',
                'balai_sosial_rusak_sedang' => 'nullable|integer',
                'balai_sosial_rusak_ringan' => 'nullable|integer',
                'harga_satuan_balai_sosial' => 'nullable|numeric',
                'bantuan_sosial_rusak' => 'nullable|numeric',
                'harga_satuan_bantuan_sosial' => 'nullable|numeric',
            ]);

            // Create new form data
            $formSosial = Format4Form4::create($validated);

            DB::commit();

            // Return success response for AJAX or redirect for regular form
            if ($request->ajax()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Data berhasil disimpan',
                    'data' => $formSosial
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
        $formSosial = Format4Form4::with('bencana')->findOrFail($id);
        $bencana = $formSosial->bencana;
        
        return view('forms.form4.format4.show-format4', compact('formSosial', 'bencana'));
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
        $formData = Format4Form4::where('bencana_id', $bencana_id)->get();
        
        return view('forms.form4.format4.format4list', compact('bencana', 'formData'));
    }

    /**
     * Generate PDF for a specific form data
     */
    public function generatePdf($id)
    {
        $formSosial = Format4Form4::with('bencana')->findOrFail($id);
        $bencana = $formSosial->bencana;
        
        $pdf = Pdf::loadView('forms.form4.format4.pdf', compact('formSosial', 'bencana'));
        $pdf->setPaper('A4', 'landscape');
        
        return $pdf->download('Format4_Sosial_' . $formSosial->nama_kampung . '.pdf');
    }

    /**
     * Preview PDF for a specific form data
     */
    public function previewPdf($id)
    {
        $formSosial = Format4Form4::with('bencana')->findOrFail($id);
        $bencana = $formSosial->bencana;
        
        $pdf = Pdf::loadView('forms.form4.format4.pdf', compact('formSosial', 'bencana'));
        $pdf->setPaper('A4', 'landscape');
        
        return $pdf->stream('Format4_Sosial_' . $formSosial->nama_kampung . '.pdf');
    }
}
