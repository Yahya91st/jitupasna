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
        $formData = Format6Form4::where('bencana_id', $bencana_id)->get();
        
        return view('forms.form4.format6.format6list', compact('bencana', 'formData'));
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
                'sumur_gali_rusak_total' => 'nullable|integer',
                'sumur_gali_rusak_sebagian' => 'nullable|integer',
                'harga_satuan_sumur_gali' => 'nullable|numeric',
                'sumur_bor_rusak_total' => 'nullable|integer',
                'sumur_bor_rusak_sebagian' => 'nullable|integer',
                'harga_satuan_sumur_bor' => 'nullable|numeric',
                'mata_air_rusak_total' => 'nullable|integer',
                'mata_air_rusak_sebagian' => 'nullable|integer',
                'harga_satuan_mata_air' => 'nullable|numeric',
                'penampungan_air_rusak_total' => 'nullable|integer',
                'penampungan_air_rusak_sebagian' => 'nullable|integer',
                'harga_satuan_penampungan' => 'nullable|numeric',
                'saluran_air_rusak_berat' => 'nullable|numeric',
                'saluran_air_rusak_sedang' => 'nullable|numeric',
                'saluran_air_rusak_ringan' => 'nullable|numeric',
                'harga_satuan_saluran_air' => 'nullable|numeric',
                'wc_umum_rusak_total' => 'nullable|integer',
                'wc_umum_rusak_sebagian' => 'nullable|integer',
                'harga_satuan_wc_umum' => 'nullable|numeric',
            ]);

            // Create new form data
            $formAirBersih = Format6Form4::create($validated);

            DB::commit();

            // Return success response for AJAX or redirect for regular form
            if ($request->ajax()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Data berhasil disimpan',
                    'data' => $formAirBersih
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
        $formAirBersih = Format6Form4::with('bencana')->findOrFail($id);
        $bencana = $formAirBersih->bencana;
        
        return view('forms.form4.format6.show-format6', compact('formAirBersih', 'bencana'));
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
        $formData = Format6Form4::where('bencana_id', $bencana_id)->get();
        
        return view('forms.form4.format6.format6list', compact('bencana', 'formData'));
    }

    /**
     * Generate PDF for a specific form data
     */
    public function generatePdf($id)
    {
        $formAirBersih = Format6Form4::with('bencana')->findOrFail($id);
        $bencana = $formAirBersih->bencana;
        
        $pdf = Pdf::loadView('forms.form4.format6.pdf', compact('formAirBersih', 'bencana'));
        $pdf->setPaper('A4', 'landscape');
        
        return $pdf->download('Format6_AirBersih_' . $formAirBersih->nama_kampung . '.pdf');
    }

    /**
     * Preview PDF for a specific form data
     */
    public function previewPdf($id)
    {
        $formAirBersih = Format6Form4::with('bencana')->findOrFail($id);
        $bencana = $formAirBersih->bencana;
        
        $pdf = Pdf::loadView('forms.form4.format6.pdf', compact('formAirBersih', 'bencana'));
        $pdf->setPaper('A4', 'landscape');
        
        return $pdf->stream('Format6_AirBersih_' . $formAirBersih->nama_kampung . '.pdf');
    }
}
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
            // Basic validation - customize based on format6 requirements
            $validated = $request->validate([
                'bencana_id' => 'required|exists:bencana,id',
                'nama_kampung' => 'required|string',
                'nama_distrik' => 'required|string',
                // Add more validation rules based on format6 form fields
            ]);

            // TODO: Create Format6Form4 model and implement data storage
            // For now, return success message
            return redirect()->back()->with('success', 'Data Format 6 (Clean Water and Sanitation Sector) berhasil disimpan');

        } catch (\Exception $e) {
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
        // TODO: Implement show method after creating Format6Form4 model
        return view('forms.form4.format6.not-implemented');
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
        
        // TODO: Get form data for this disaster after creating Format6Form4 model
        $formData = collect(); // Empty collection for now
        
        return view('forms.form4.format6.format6list', compact('bencana', 'formData'));
    }

    /**
     * Generate PDF for a specific form data
     */
    public function generatePdf($id)
    {
        // TODO: Implement PDF generation after creating Format6Form4 model
        return redirect()->back()->with('error', 'Fitur PDF belum diimplementasikan untuk Format 6');
    }

    /**
     * Preview PDF for a specific form data
     */
    public function previewPdf($id)
    {
        // TODO: Implement PDF preview after creating Format6Form4 model
        return redirect()->back()->with('error', 'Fitur Preview PDF belum diimplementasikan untuk Format 6');
    }
}
