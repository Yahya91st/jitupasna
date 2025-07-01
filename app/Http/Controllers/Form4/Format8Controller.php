<?php

namespace App\Http\Controllers\Form4;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Bencana;
use App\Models\Format8Form4;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;

class Format8Controller extends Controller
{
    /**
     * Display Format 8 form for Electricity sector data collection
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
        
        return view('forms.form4.format8.format8form4', compact('bencana'));
    }

    /**
     * Store format8 form data for Electricity sector
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
                // Electricity sector specific fields
                'gardu_listrik_rusak_total' => 'nullable|integer',
                'gardu_listrik_rusak_sebagian' => 'nullable|integer',
                'harga_satuan_gardu' => 'nullable|numeric',
                'jaringan_primer_rusak' => 'nullable|numeric',
                'harga_satuan_jaringan_primer' => 'nullable|numeric',
                'jaringan_sekunder_rusak' => 'nullable|numeric',
                'harga_satuan_jaringan_sekunder' => 'nullable|numeric',
                'tiang_listrik_rusak' => 'nullable|integer',
                'harga_satuan_tiang_listrik' => 'nullable|numeric',
                'transformer_rusak' => 'nullable|integer',
                'harga_satuan_transformer' => 'nullable|numeric',
                'panel_listrik_rusak' => 'nullable|integer',
                'harga_satuan_panel_listrik' => 'nullable|numeric',
                'genset_rusak' => 'nullable|integer',
                'harga_satuan_genset' => 'nullable|numeric',
            ]);

            // Create new form data
            $formListrik = Format8Form4::create($validated);

            DB::commit();

            // Return success response for AJAX or redirect for regular form
            if ($request->ajax()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Data berhasil disimpan',
                    'data' => $formListrik
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
        $formListrik = Format8Form4::with('bencana')->findOrFail($id);
        $bencana = $formListrik->bencana;
        
        return view('forms.form4.format8.show-format8', compact('formListrik', 'bencana'));
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
        $formData = Format8Form4::where('bencana_id', $bencana_id)->get();
        
        return view('forms.form4.format8.format8list', compact('bencana', 'formData'));
    }

    /**
     * Generate PDF for a specific form data
     */
    public function generatePdf($id)
    {
        $formListrik = Format8Form4::with('bencana')->findOrFail($id);
        $bencana = $formListrik->bencana;
        
        $pdf = Pdf::loadView('forms.form4.format8.pdf', compact('formListrik', 'bencana'));
        $pdf->setPaper('A4', 'landscape');
        
        return $pdf->download('Format8_Listrik_' . $formListrik->nama_kampung . '.pdf');
    }

    /**
     * Preview PDF for a specific form data
     */
    public function previewPdf($id)
    {
        $formListrik = Format8Form4::with('bencana')->findOrFail($id);
        $bencana = $formListrik->bencana;
        
        $pdf = Pdf::loadView('forms.form4.format8.pdf', compact('formListrik', 'bencana'));
        $pdf->setPaper('A4', 'landscape');
        
        return $pdf->stream('Format8_Listrik_' . $formListrik->nama_kampung . '.pdf');    }
}
