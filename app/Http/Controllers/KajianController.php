<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bencana;
use App\Models\KategoriBencana;

class KajianController extends Controller
{
    public function index(Request $request)
    {
        $bencana_id = $request->input('bencana_id');
        $bencana = null;
        
        // Redirect to bencana selection page if no bencana_id is provided
        if (!$bencana_id) {
            return redirect()->route('bencana.index', ['source' => 'kajian']);
        }
        
        // Get bencana details if ID is provided
        $bencana = Bencana::findOrFail($bencana_id);        
        return view('kajian.index', compact('bencana'));
        
    }
    public function show(Request $request, $id)
    {
        $kajian = Kajian::with(['bencana', 'kategori_bangunan', 'detail.satuan', 'detail.hsd'])
            ->findOrFail($id);
        // Cari bencana berdasarkan $id dari URL
        $bencana = Bencana::findOrFail($id);
        // TODO: tambahkan data kajian jika sudah ada tabel/model Kajian
        return view('kajian.show', compact('bencana'));
    }
    public function createAkses()
    {
        return view('kajian.form.akses');
    }
    public function createFungsi()
    {
        return view('kajian.form.fungsi');
    }
    public function createResiko()
    {
        return view('kajian.form.resiko');
    }    // public function store(Request $request)
    // {
    //     // Validasi data
    //     $validated = $request->validate([
    //         'judul' => 'required|string|max:255',
    //         'deskripsi' => 'required|string',
    //         'tanggal' => 'required|date',
    //         'lokasi' => 'required|string|max:255',
    //         'file' => 'nullable|file|mimes:pdf,doc,docx|max:2048',
    //     ]);
    // }
    public function list(Request $request)
    {
        $kategoriBencana = KategoriBencana::query()->get();
        $bencanaQuery = Bencana::query()->with('desa')->with('kategori_bencana')->latest();
        
        if ($request->filled('kategori_bencana_id')) {
            $bencanaQuery->where('kategori_bencana_id', '=', $request->input('kategori_bencana_id'));
        }
        
        $bencana = $bencanaQuery->paginate($request->input('limit', 5))->appends($request->except('page'));

        return view('kajian.list', [
            'bencana' => $bencana,
            'kategoribencana' => $kategoriBencana,
        ]);
    }
}
