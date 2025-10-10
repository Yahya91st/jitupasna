<?php

namespace App\Http\Controllers\Form4;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Bencana;
use App\Models\Format7Form4;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;

class Format7Controller extends Controller
{
    /**
     * Display Format 7 form for Transportation sector data collection
     */
    public function index(Request $request)
    {
        $bencana_id = $request->input('bencana_id');
        
        // Redirect to bencana selection if no bencana_id is provided
        if (!$bencana_id) {            return redirect()->route('bencana.index', ['source' => 'forms']);        }
        
        // Get bencana details
        $bencana = Bencana::findOrFail($bencana_id);
        
        return view('forms.form4.format7.format7form4', compact('bencana'));
    }

    /**
     * Store format7 form data for Transportation sector
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
                // Transportation sector specific fields
                'jalan_aspal_rusak' => 'nullable|numeric',
                'harga_satuan_jalan_aspal' => 'nullable|numeric',
                'jalan_beton_rusak' => 'nullable|numeric',
                'harga_satuan_jalan_beton' => 'nullable|numeric',
                'jalan_tanah_rusak' => 'nullable|numeric',
                'harga_satuan_jalan_tanah' => 'nullable|numeric',
                'jembatan_rusak' => 'nullable|integer',
                'harga_satuan_jembatan' => 'nullable|numeric',
                'dermaga_rusak' => 'nullable|integer',
                'harga_satuan_dermaga' => 'nullable|numeric',
                'bandara_rusak' => 'nullable|integer',
                'harga_satuan_bandara' => 'nullable|numeric',
                'terminal_rusak' => 'nullable|integer',
                'harga_satuan_terminal' => 'nullable|numeric',
            ]);

            // Create new form data
            $formTransportasi = Format7Form4::create($validated);

            DB::commit();

            // Return success response for AJAX or redirect for regular form
            if ($request->ajax()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Data berhasil disimpan',
                    'data' => $formTransportasi
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
        $formTransportasi = Format7Form4::with('bencana')->findOrFail($id);
        $bencana = $formTransportasi->bencana;
        
        return view('forms.form4.format7.show-format7', compact('formTransportasi', 'bencana'));
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
        $formData = Format7Form4::where('bencana_id', $bencana_id)->get();
        
        return view('forms.form4.format7.format7list', compact('bencana', 'formData'));
    }

    /**
     * Generate PDF for a specific form data
     */
    public function generatePdf($id)
    {
        $formTransportasi = Format7Form4::with('bencana')->findOrFail($id);
        $bencana = $formTransportasi->bencana;
        
        $pdf = Pdf::loadView('forms.form4.format7.pdf', compact('formTransportasi', 'bencana'));
        $pdf->setPaper('A4', 'landscape');
        
        return $pdf->download('Format7_Transportasi_' . $formTransportasi->nama_kampung . '.pdf');
    }

    /**
     * Preview PDF for a specific form data
     */
    public function previewPdf($id)
    {
        $formTransportasi = Format7Form4::with('bencana')->findOrFail($id);
        $bencana = $formTransportasi->bencana;
        
        $pdf = Pdf::loadView('forms.form4.format7.pdf', compact('formTransportasi', 'bencana'));
        $pdf->setPaper('A4', 'landscape');
        
        return $pdf->stream('Format7_Transportasi_' . $formTransportasi->nama_kampung . '.pdf');
    }
}
