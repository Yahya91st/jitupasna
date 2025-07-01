<?php

namespace App\Http\Controllers\Form4;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Bencana;
use App\Models\Format14Form4;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;

class Format14Controller extends Controller
{
    /**
     * Display Format 14 form for data collection
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
        
        return view('forms.form4.format14.format14form4', compact('bencana'));
    }

    /**
     * Store format14 form data
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
                // Format 14 specific fields - customize based on actual form requirements
                'item_rusak_1' => 'nullable|string',
                'jumlah_rusak_1' => 'nullable|integer',
                'harga_satuan_1' => 'nullable|numeric',
                'item_rusak_2' => 'nullable|string',
                'jumlah_rusak_2' => 'nullable|integer',
                'harga_satuan_2' => 'nullable|numeric',
                'item_rusak_3' => 'nullable|string',
                'jumlah_rusak_3' => 'nullable|integer',
                'harga_satuan_3' => 'nullable|numeric',
                'item_rusak_4' => 'nullable|string',
                'jumlah_rusak_4' => 'nullable|integer',
                'harga_satuan_4' => 'nullable|numeric',
                'item_rusak_5' => 'nullable|string',
                'jumlah_rusak_5' => 'nullable|integer',
                'harga_satuan_5' => 'nullable|numeric',
                'total_biaya' => 'nullable|numeric',
                'keterangan' => 'nullable|string',
            ]);

            // Create new form data
            $formData = Format14Form4::create($validated);

            DB::commit();

            // Return success response for AJAX or redirect for regular form
            if ($request->ajax()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Data berhasil disimpan',
                    'data' => $formData
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
        $formData = Format14Form4::with('bencana')->findOrFail($id);
        $bencana = $formData->bencana;
        
        return view('forms.form4.format14.show-format14', compact('formData', 'bencana'));
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
        $formDataList = Format14Form4::where('bencana_id', $bencana_id)->get();
        
        return view('forms.form4.format14.format14list', compact('bencana', 'formDataList'));
    }

    /**
     * Generate PDF for a specific form data
     */
    public function generatePdf($id)
    {
        $formData = Format14Form4::with('bencana')->findOrFail($id);
        $bencana = $formData->bencana;
        
        $pdf = Pdf::loadView('forms.form4.format14.pdf', compact('formData', 'bencana'));
        $pdf->setPaper('A4', 'landscape');
        
        return $pdf->download('Format14_' . $formData->nama_kampung . '.pdf');
    }

    /**
     * Preview PDF for a specific form data
     */
    public function previewPdf($id)
    {
        $formData = Format14Form4::with('bencana')->findOrFail($id);
        $bencana = $formData->bencana;
        
        $pdf = Pdf::loadView('forms.form4.format14.pdf', compact('formData', 'bencana'));
        $pdf->setPaper('A4', 'landscape');
        
        return $pdf->stream('Format14_' . $formData->nama_kampung . '.pdf');
    }
}
