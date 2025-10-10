<?php

namespace App\Http\Controllers\Form4;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Bencana;
use App\Models\Format6Form4;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;

class Format6Controller extends Controller
{
    /**
     * Display Format 6 form for Clean Water and Sanitation sector data collection
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
        
        return view('forms.form4.format6.format6form4', compact('bencana'));
    }

    /**
     * Store format6 form data for Clean Water and Sanitation sector
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
                // Clean Water and Sanitation sector specific fields
                'sumur_bor_rusak' => 'nullable|integer',
                'harga_satuan_sumur_bor' => 'nullable|numeric',
                'sumur_gali_rusak' => 'nullable|integer',
                'harga_satuan_sumur_gali' => 'nullable|numeric',
                'mata_air_rusak' => 'nullable|integer',
                'harga_satuan_mata_air' => 'nullable|numeric',
                'instalasi_pam_rusak' => 'nullable|integer',
                'harga_satuan_instalasi_pam' => 'nullable|numeric',
                'pipa_distribusi_rusak' => 'nullable|numeric',
                'harga_satuan_pipa_distribusi' => 'nullable|numeric',
                'tangki_air_rusak' => 'nullable|integer',
                'harga_satuan_tangki_air' => 'nullable|numeric',
                'mck_rusak' => 'nullable|integer',
                'harga_satuan_mck' => 'nullable|numeric',
                'septictank_rusak' => 'nullable|integer',
                'harga_satuan_septictank' => 'nullable|numeric',
            ]);

            // Create new form data
            $formAirSanitasi = Format6Form4::create($validated);

            DB::commit();

            // Return success response for AJAX or redirect for regular form
            if ($request->ajax()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Data berhasil disimpan',
                    'data' => $formAirSanitasi
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
        $formAirSanitasi = Format6Form4::with('bencana')->findOrFail($id);
        $bencana = $formAirSanitasi->bencana;
        
        return view('forms.form4.format6.show-format6', compact('formAirSanitasi', 'bencana'));
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
         $form = Format6Form4::where('bencana_id', $bencana_id)->get();
        
        return view('forms.form4.format6.format6list', compact('bencana', ' form'));
    }

    /**
     * Generate PDF for a specific form data
     */
    public function generatePdf($id)
    {
        $formAirSanitasi = Format6Form4::with('bencana')->findOrFail($id);
        $bencana = $formAirSanitasi->bencana;
        
        $pdf = Pdf::loadView('forms.form4.format6.pdf', compact('formAirSanitasi', 'bencana'));
        $pdf->setPaper('A4', 'landscape');
        
        return $pdf->download('Format6_AirSanitasi_' . $formAirSanitasi->nama_kampung . '.pdf');
    }

    /**
     * Preview PDF for a specific form data
     */
    public function previewPdf($id)
    {
        $formAirSanitasi = Format6Form4::with('bencana')->findOrFail($id);
        $bencana = $formAirSanitasi->bencana;
        
        $pdf = Pdf::loadView('forms.form4.format6.pdf', compact('formAirSanitasi', 'bencana'));
        $pdf->setPaper('A4', 'landscape');
        
        return $pdf->stream('Format6_AirSanitasi_' . $formAirSanitasi->nama_kampung . '.pdf');
    }
}
