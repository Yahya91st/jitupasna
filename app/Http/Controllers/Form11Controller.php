<?php

namespace App\Http\Controllers;

use App\Models\Rekapitulasi;
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

        $rekapitulasi = new Rekapitulasi();
        $rekapitulasi->bencana_id = $request->bencana_id;
        $rekapitulasi->sektor = $request->sektor;
        $rekapitulasi->sub_sektor = $request->sub_sektor;
        $rekapitulasi->lokasi = $request->lokasi;
        $rekapitulasi->jenis_kebutuhan = $request->jenis_kebutuhan;
        $rekapitulasi->rincian_kebutuhan = $request->rincian_kebutuhan;
        $rekapitulasi->jumlah_unit = $request->jumlah_unit;
        $rekapitulasi->satuan = $request->satuan;
        $rekapitulasi->harga_satuan = $request->harga_satuan;
        $rekapitulasi->total_kebutuhan = $totalKebutuhan;
        $rekapitulasi->prioritas = $request->prioritas;
        $rekapitulasi->durasi_penyelesaian = $request->durasi_penyelesaian;
        $rekapitulasi->penanggung_jawab = $request->penanggung_jawab;
        $rekapitulasi->keterangan = $request->keterangan;
        $rekapitulasi->created_by = Auth::id();
        $rekapitulasi->save();

        return redirect()->route('forms.form11.show', $rekapitulasi->id)->with('success', 'Data rekapitulasi kebutuhan berhasil disimpan.');
    }
    
    /**
     * Display the specified Rekapitulasi
     */
    public function show($id)
    {
        $rekapitulasi = Rekapitulasi::with('bencana')->findOrFail($id);
        return view('forms.form11.show', compact('rekapitulasi'));
    }
    
    /**
     * Show the form for editing the specified Rekapitulasi
     */
    public function edit($id)
    {
        $rekapitulasi = Rekapitulasi::findOrFail($id);
        $bencanas = Bencana::all();
        return view('forms.form11.edit', compact('rekapitulasi', 'bencanas'));
    }
    
    /**
     * Update the specified Rekapitulasi in database
     */
    public function update(Request $request, $id)
    {
        $rekapitulasi = Rekapitulasi::findOrFail($id);
        
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

        $rekapitulasi->bencana_id = $request->bencana_id;
        $rekapitulasi->sektor = $request->sektor;
        $rekapitulasi->sub_sektor = $request->sub_sektor;
        $rekapitulasi->lokasi = $request->lokasi;
        $rekapitulasi->jenis_kebutuhan = $request->jenis_kebutuhan;
        $rekapitulasi->rincian_kebutuhan = $request->rincian_kebutuhan;
        $rekapitulasi->jumlah_unit = $request->jumlah_unit;
        $rekapitulasi->satuan = $request->satuan;
        $rekapitulasi->harga_satuan = $request->harga_satuan;
        $rekapitulasi->total_kebutuhan = $totalKebutuhan;
        $rekapitulasi->prioritas = $request->prioritas;
        $rekapitulasi->durasi_penyelesaian = $request->durasi_penyelesaian;
        $rekapitulasi->penanggung_jawab = $request->penanggung_jawab;
        $rekapitulasi->keterangan = $request->keterangan;
        $rekapitulasi->updated_by = Auth::id();
        $rekapitulasi->save();

        return redirect()->route('forms.form11.show', $rekapitulasi->id)->with('success', 'Data rekapitulasi kebutuhan berhasil diperbarui.');
    }
    
    /**
     * Display a listing of Rekapitulasi
     */
    public function list(Request $request)
    {
        $bencana_id = $request->query('bencana_id');
        $query = Rekapitulasi::with('bencana');
        
        if ($bencana_id) {
            $bencana = Bencana::findOrFail($bencana_id);
            $query->where('bencana_id', $bencana_id);
            $rekapitulasiList = $query->orderBy('created_at', 'desc')->get();
            return view('forms.form11.list', compact('rekapitulasiList', 'bencana'));
        }
        
        $rekapitulasiList = $query->orderBy('created_at', 'desc')->paginate(10);
        return view('forms.form11.list', compact('rekapitulasiList'));
    }
    
    /**
     * Generate PDF document from Rekapitulasi
     */
    public function generatePdf($id)
    {
        $rekapitulasi = Rekapitulasi::with('bencana')->findOrFail($id);
        $pdf = PDF::loadView('forms.form11.pdf', compact('rekapitulasi'));
        return $pdf->download('formulir-11-rekapitulasi-' . $rekapitulasi->id . '.pdf');
    }
    
    /**
     * Preview PDF document from Rekapitulasi
     */
    public function previewPdf($id)
    {
        $rekapitulasi = Rekapitulasi::with('bencana')->findOrFail($id);
        return view('forms.form11.pdf', compact('rekapitulasi'));
    }
}
