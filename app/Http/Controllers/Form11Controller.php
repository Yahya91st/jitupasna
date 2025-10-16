<?php

namespace App\Http\Controllers;

use App\Models\Form11;
use App\Models\Bencana;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Barryvdh\DomPDF\Facade\Pdf;

class Form11Controller extends Controller
{
    /**
     * Display the form for creating a new Rekapitulasi
     */
    public function index(Request $request)
    {
        $bencana_id = $request->query('bencana_id');
        $bencana = null;
        
        if ($bencana_id) {
            $bencana = Bencana::find($bencana_id);
        } else {
            $bencanas = Bencana::all();
            return view('forms.form11.form11', compact('bencanas'));
        }
        
        return view('forms.form11.form11', compact('bencana'));
    }
    
    /**
     * Store a newly created Rekapitulasi in database
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'bencana_id' => 'required|exists:bencana,id',
            'sektor' => 'required|string|max:255',
            'sub_sektor' => 'required|string|max:255',
            'lokasi' => 'required|string|max:255',
            'jenis_kebutuhan' => 'required|string',
            'rincian_kebutuhan' => 'required|string',
            'jumlah_unit' => 'required|numeric|min:0',
            'satuan' => 'required|string|max:100',
            'harga_satuan' => 'required|numeric|min:0',
            'prioritas' => 'required|string|in:Tinggi,Sedang,Rendah',
            'durasi_penyelesaian' => 'required|string|max:255',
            'penanggung_jawab' => 'required|string|max:255',
            'keterangan' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Calculate total kebutuhan
        $totalKebutuhan = $request->jumlah_unit * $request->harga_satuan;

        $form11 = new Form11();
        $form11->bencana_id = $request->bencana_id;
        $form11->sektor = $request->sektor;
        $form11->sub_sektor = $request->sub_sektor;
        $form11->lokasi = $request->lokasi;
        $form11->jenis_kebutuhan = $request->jenis_kebutuhan;
        $form11->rincian_kebutuhan = $request->rincian_kebutuhan;
        $form11->jumlah_unit = $request->jumlah_unit;
        $form11->satuan = $request->satuan;
        $form11->harga_satuan = $request->harga_satuan;
        $form11->total_kebutuhan = $totalKebutuhan;
        $form11->prioritas = $request->prioritas;
        $form11->durasi_penyelesaian = $request->durasi_penyelesaian;
        $form11->penanggung_jawab = $request->penanggung_jawab;
        $form11->keterangan = $request->keterangan;
        $form11->created_by = Auth::id();
        $form11->save();

        return redirect()->route('forms.form11.show', $form11->id)->with('success', 'Data rekapitulasi kebutuhan berhasil disimpan.');
    }
    
    /**
     * Display the specified Rekapitulasi
     */
    public function show($id)
    {
        $form11 = Form11::with('bencana')->findOrFail($id);
        return view('forms.form11.show', compact('form11'));
    }
    
    /**
     * Show the form for editing the specified Rekapitulasi
     */
    public function edit($id)
    {
        $form11 = Form11::findOrFail($id);
        $bencanas = Bencana::all();
        return view('forms.form11.edit', compact('form11', 'bencanas'));
    }
    
    /**
     * Update the specified Rekapitulasi in database
     */
    public function update(Request $request, $id)
    {
        $form11 = Form11::findOrFail($id);
        
        $validator = Validator::make($request->all(), [
            'bencana_id' => 'required|exists:bencana,id',
            'sektor' => 'required|string|max:255',
            'sub_sektor' => 'required|string|max:255',
            'lokasi' => 'required|string|max:255',
            'jenis_kebutuhan' => 'required|string',
            'rincian_kebutuhan' => 'required|string',
            'jumlah_unit' => 'required|numeric|min:0',
            'satuan' => 'required|string|max:100',
            'harga_satuan' => 'required|numeric|min:0',
            'prioritas' => 'required|string|in:Tinggi,Sedang,Rendah',
            'durasi_penyelesaian' => 'required|string|max:255',
            'penanggung_jawab' => 'required|string|max:255',
            'keterangan' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        
        // Calculate total kebutuhan
        $totalKebutuhan = $request->jumlah_unit * $request->harga_satuan;

        $form11->bencana_id = $request->bencana_id;
        $form11->sektor = $request->sektor;
        $form11->sub_sektor = $request->sub_sektor;
        $form11->lokasi = $request->lokasi;
        $form11->jenis_kebutuhan = $request->jenis_kebutuhan;
        $form11->rincian_kebutuhan = $request->rincian_kebutuhan;
        $form11->jumlah_unit = $request->jumlah_unit;
        $form11->satuan = $request->satuan;
        $form11->harga_satuan = $request->harga_satuan;
        $form11->total_kebutuhan = $totalKebutuhan;
        $form11->prioritas = $request->prioritas;
        $form11->durasi_penyelesaian = $request->durasi_penyelesaian;
        $form11->penanggung_jawab = $request->penanggung_jawab;
        $form11->keterangan = $request->keterangan;
        $form11->updated_by = Auth::id();
        $form11->save();

        return redirect()->route('forms.form11.show', $form11->id)->with('success', 'Data rekapitulasi kebutuhan berhasil diperbarui.');
    }
    
    /**
     * Display a listing of Rekapitulasi
     */
    public function list(Request $request)
    {
        $bencana_id = $request->query('bencana_id');
        $query = Form11::with('bencana');
        
        if ($bencana_id) {
            $bencana = Bencana::findOrFail($bencana_id);
            $query->where('bencana_id', $bencana_id);
            $form11List = $query->orderBy('created_at', 'desc')->get();
            return view('forms.form11.list', compact('form11List', 'bencana'));
        }
        
        $form11List = $query->orderBy('created_at', 'desc')->paginate(10);
        return view('forms.form11.list', compact('form11List'));
    }
    
    /**
     * Generate PDF document from Form11
     */
    public function generatePdf($id)
    {
        $form11 = Form11::with('bencana')->findOrFail($id);
        $pdf = PDF::loadView('forms.form11.pdf', compact('form11'));
        return $pdf->download('formulir-11-rekapitulasi-' . $form11->id . '.pdf');
    }
    
    /**
     * Preview PDF document from Form11
     */
    public function previewPdf($id)
    {
        $form11 = Form11::with('bencana')->findOrFail($id);
        return view('forms.form11.pdf', compact('form11'));
    }

    public function destroy($id)
    {
        try {
            $form11 = Form11::findOrFail($id);
            $bencana_id = $form11->bencana_id;
            $form11->delete();
            
            return redirect()->route('forms.form11.list', ['bencana_id' => $bencana_id])
                ->with('success', 'Data Form 11 berhasil dihapus');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
    public function contohPdf()
    {

        $pdf = Pdf::loadView('forms.form11.contoh_form11_pdf', []);
        return $pdf->stream('Contoh_Formulir_11_PDNA.pdf');
    }
}
