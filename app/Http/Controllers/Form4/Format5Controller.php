<?php

namespace App\Http\Controllers\Form4;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Bencana;
use App\Models\Format5Form4;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;

class Format5Controller extends Controller
{
    /**
     * Display Format 5 form for Religious sector data collection
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
        
        return view('forms.form4.format5.format5form4', compact('bencana'));
    }

    /**
     * Store format5 form data for Religious sector
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
                // Format 5 fields - all others are optional
            ]);

            // Save all user input fields as per $fillable
            $data = $request->only((new Format5Form4)->getFillable());
            
            // Ensure numeric fields are properly cast
            foreach ($data as $key => $value) {
                if (empty($value) || $value === '') {
                    $data[$key] = null;
                }
            }
            
            $formAgama = Format5Form4::create($data);

            DB::commit();

            if ($request->ajax()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Data berhasil disimpan',
                    'data' => $formAgama
                ]);
            }

            return redirect()->route('forms.form4.format5.list', ['bencana_id' => $formAgama->bencana_id])
                ->with('success', 'Data berhasil disimpan');

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
        $formAgama = Format5Form4::with('bencana')->findOrFail($id);
        $bencana = $formAgama->bencana;
        
        return view('forms.form4.format5.show-format5', compact('formAgama', 'bencana'));
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
        $formData = Format5Form4::where('bencana_id', $bencana_id)->get();
        $reports = $formData; // For compatibility with the view
        return view('forms.form4.format5.list-format5', compact('bencana', 'formData', 'reports'));
    }

    /**
     * Generate PDF for a specific form data
     */
    public function generatePdf($id)
    {
        $formAgama = Format5Form4::with('bencana')->findOrFail($id);
        $bencana = $formAgama->bencana;
        
        $pdf = Pdf::loadView('forms.form4.format5.pdf', compact('formAgama', 'bencana'));
        $pdf->setPaper('A4', 'landscape');
        
        return $pdf->download('Format5_Agama_' . $formAgama->nama_kampung . '.pdf');
    }

    /**
     * Preview PDF for a specific form data
     */
    public function previewPdf($id)
    {
        $formAgama = Format5Form4::with('bencana')->findOrFail($id);
        $bencana = $formAgama->bencana;
        
        $pdf = Pdf::loadView('forms.form4.format5.pdf', compact('formAgama', 'bencana'));
        $pdf->setPaper('A4', 'landscape');
        
        return $pdf->stream('Format5_Agama_' . $formAgama->nama_kampung . '.pdf');
    }

    /**
     * Show the form for editing the specified resource (Format 5)
     */
    public function edit($id)
    {
        $formKeagamaan = Format5Form4::with('bencana')->findOrFail($id);
        $bencana = $formKeagamaan->bencana;
        return view('forms.form4.format5.edit', compact('formKeagamaan', 'bencana'));
    }

    /**
     * Update the specified resource in storage (Format 5)
     */
    public function update(Request $request, $id)
    {
        try {
            DB::beginTransaction();
            
            $formAgama = Format5Form4::findOrFail($id);
            
            $validated = $request->validate([
                'bencana_id' => 'required|exists:bencana,id',
                'nama_kampung' => 'required|string',
                'nama_distrik' => 'required|string',
                // All other fields are optional
            ]);
            
            // Get all fillable data from request
            $data = $request->only((new Format5Form4)->getFillable());
            
            // Ensure numeric fields are properly cast
            foreach ($data as $key => $value) {
                if (empty($value) || $value === '') {
                    $data[$key] = null;
                }
            }
            
            $formAgama->update($data);
            
            DB::commit();
            
            return redirect()->route('forms.form4.format5.list', ['bencana_id' => $validated['bencana_id']])
                ->with('success', 'Data berhasil diupdate');
                
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withInput()->withErrors(['error' => 'Terjadi kesalahan saat update data. ' . $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage (Format 5)
     */
    public function destroy($id)
    {
        $formAgama = Format5Form4::findOrFail($id);
        $bencana_id = $formAgama->bencana_id;
        $formAgama->delete();
        return redirect()->route('forms.form4.format5.list', ['bencana_id' => $bencana_id])
            ->with('success', 'Data berhasil dihapus');
    }
}
