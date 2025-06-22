<?php

namespace App\Http\Controllers;

use App\Models\Bencana;
use App\Models\Rumahtangga;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Barryvdh\DomPDF\Facade\Pdf;

class Form6Controller extends Controller
{    public function index()
    {
        $bencanas = Bencana::all();
        return view('forms.form6.form6', compact('bencanas'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'bencana_id' => 'required|exists:bencana,id',
            'provinsi' => 'required|string|max:100',
            'kabupaten' => 'required|string|max:100',
            'kecamatan' => 'required|string|max:100',
            'desa' => 'required|string|max:100',
            'dusun' => 'required|string|max:100',
            'rt' => 'required|string|max:10',
            'rw' => 'required|string|max:10',
            'nama_kk' => 'required|string|max:255',
            'nik_kk' => 'required|string|max:25',
            'jumlah_anggota' => 'required|integer',
            'status_rumah' => 'required|string|max:50',
            'kategori_kerusakan' => 'required|string|max:50',
            'nomor_hp' => 'required|string|max:20',
            'status_hunian' => 'required|string|max:50',
            'status_bantuan' => 'required|string|max:10',
            'foto_rumah' => 'required|image|max:2048',
            'foto_ktp' => 'required|image|max:2048',
            'foto_kk' => 'required|image|max:2048',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Handle file uploads
        $fotoRumah = $request->file('foto_rumah');
        $fotoKtp = $request->file('foto_ktp');
        $fotoKk = $request->file('foto_kk');
        
        $fotoRumahPath = $fotoRumah->store('uploads/rumahtangga', 'public');
        $fotoKtpPath = $fotoKtp->store('uploads/rumahtangga', 'public');
        $fotoKkPath = $fotoKk->store('uploads/rumahtangga', 'public');

        $rumahtangga = new Rumahtangga();
        $rumahtangga->bencana_id = $request->bencana_id;
        $rumahtangga->provinsi = $request->provinsi;
        $rumahtangga->kabupaten = $request->kabupaten;
        $rumahtangga->kecamatan = $request->kecamatan;
        $rumahtangga->desa = $request->desa;
        $rumahtangga->dusun = $request->dusun;
        $rumahtangga->rt = $request->rt;
        $rumahtangga->rw = $request->rw;
        $rumahtangga->nama_kk = $request->nama_kk;
        $rumahtangga->nik_kk = $request->nik_kk;
        $rumahtangga->jumlah_anggota = $request->jumlah_anggota;
        $rumahtangga->status_rumah = $request->status_rumah;
        $rumahtangga->kebutuhan_material = $request->kebutuhan_material ?? '';
        $rumahtangga->kebutuhan_sdm = $request->kebutuhan_sdm ?? '';
        $rumahtangga->kebutuhan_dana = $request->kebutuhan_dana ?? 0;
        $rumahtangga->kategori_kerusakan = $request->kategori_kerusakan;
        $rumahtangga->keterangan_tambahan = $request->keterangan_tambahan ?? '';
        $rumahtangga->foto_rumah = $fotoRumahPath;
        $rumahtangga->foto_ktp = $fotoKtpPath;
        $rumahtangga->foto_kk = $fotoKkPath;
        $rumahtangga->nomor_hp = $request->nomor_hp;
        $rumahtangga->status_hunian = $request->status_hunian;
        $rumahtangga->status_bantuan = $request->status_bantuan;
        $rumahtangga->jenis_bantuan = $request->jenis_bantuan ?? '';
        $rumahtangga->nominal_bantuan = $request->nominal_bantuan ?? 0;
        $rumahtangga->pemberi_bantuan = $request->pemberi_bantuan ?? '';
        $rumahtangga->created_by = Auth::id();
        $rumahtangga->save();

        return redirect()->route('forms.form6.show', $rumahtangga->id)->with('success', 'Data rumahtangga berhasil disimpan.');
    }    public function show($id)
    {
        $rumahtangga = Rumahtangga::with('bencana')->findOrFail($id);
        return view('forms.form6.show', compact('rumahtangga'));
    }public function edit($id)
    {
        $rumahtangga = Rumahtangga::findOrFail($id);
        $bencanas = Bencana::all();
        return view('forms.form6.edit', compact('rumahtangga', 'bencanas'));
    }

    public function update(Request $request, $id)
    {
        $rumahtangga = Rumahtangga::findOrFail($id);
        
        $validator = Validator::make($request->all(), [
            'bencana_id' => 'required|exists:bencana,id',
            'provinsi' => 'required|string|max:100',
            'kabupaten' => 'required|string|max:100',
            'kecamatan' => 'required|string|max:100',
            'desa' => 'required|string|max:100',
            'dusun' => 'required|string|max:100',
            'rt' => 'required|string|max:10',
            'rw' => 'required|string|max:10',
            'nama_kk' => 'required|string|max:255',
            'nik_kk' => 'required|string|max:25',
            'jumlah_anggota' => 'required|integer',
            'status_rumah' => 'required|string|max:50',
            'kategori_kerusakan' => 'required|string|max:50',
            'nomor_hp' => 'required|string|max:20',
            'status_hunian' => 'required|string|max:50',
            'status_bantuan' => 'required|string|max:10',
            'foto_rumah' => 'nullable|image|max:2048',
            'foto_ktp' => 'nullable|image|max:2048',
            'foto_kk' => 'nullable|image|max:2048',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Handle file uploads if new files are provided
        if ($request->hasFile('foto_rumah')) {
            // Delete old file if exists
            if ($rumahtangga->foto_rumah) {
                Storage::disk('public')->delete($rumahtangga->foto_rumah);
            }
            $fotoRumahPath = $request->file('foto_rumah')->store('uploads/rumahtangga', 'public');
            $rumahtangga->foto_rumah = $fotoRumahPath;
        }

        if ($request->hasFile('foto_ktp')) {
            if ($rumahtangga->foto_ktp) {
                Storage::disk('public')->delete($rumahtangga->foto_ktp);
            }
            $fotoKtpPath = $request->file('foto_ktp')->store('uploads/rumahtangga', 'public');
            $rumahtangga->foto_ktp = $fotoKtpPath;
        }

        if ($request->hasFile('foto_kk')) {
            if ($rumahtangga->foto_kk) {
                Storage::disk('public')->delete($rumahtangga->foto_kk);
            }
            $fotoKkPath = $request->file('foto_kk')->store('uploads/rumahtangga', 'public');
            $rumahtangga->foto_kk = $fotoKkPath;
        }

        $rumahtangga->bencana_id = $request->bencana_id;
        $rumahtangga->provinsi = $request->provinsi;
        $rumahtangga->kabupaten = $request->kabupaten;
        $rumahtangga->kecamatan = $request->kecamatan;
        $rumahtangga->desa = $request->desa;
        $rumahtangga->dusun = $request->dusun;
        $rumahtangga->rt = $request->rt;
        $rumahtangga->rw = $request->rw;
        $rumahtangga->nama_kk = $request->nama_kk;
        $rumahtangga->nik_kk = $request->nik_kk;
        $rumahtangga->jumlah_anggota = $request->jumlah_anggota;
        $rumahtangga->status_rumah = $request->status_rumah;
        $rumahtangga->kebutuhan_material = $request->kebutuhan_material ?? '';
        $rumahtangga->kebutuhan_sdm = $request->kebutuhan_sdm ?? '';
        $rumahtangga->kebutuhan_dana = $request->kebutuhan_dana ?? 0;
        $rumahtangga->kategori_kerusakan = $request->kategori_kerusakan;
        $rumahtangga->keterangan_tambahan = $request->keterangan_tambahan ?? '';
        $rumahtangga->nomor_hp = $request->nomor_hp;
        $rumahtangga->status_hunian = $request->status_hunian;
        $rumahtangga->status_bantuan = $request->status_bantuan;
        $rumahtangga->jenis_bantuan = $request->jenis_bantuan ?? '';
        $rumahtangga->nominal_bantuan = $request->nominal_bantuan ?? 0;
        $rumahtangga->pemberi_bantuan = $request->pemberi_bantuan ?? '';
        $rumahtangga->updated_by = Auth::id();
        $rumahtangga->save();

        return redirect()->route('forms.form6.show', $rumahtangga->id)->with('success', 'Data rumahtangga berhasil diperbarui.');
    }    public function listForm6()
    {
        $rumahtanggas = Rumahtangga::with('bencana')->orderBy('created_at', 'desc')->paginate(10);
        return view('forms.form6.list', compact('rumahtanggas'));
    }    public function generatePdf($id)
    {
        $rumahtangga = Rumahtangga::with('bencana')->findOrFail($id);
        $pdf = PDF::loadView('forms.form6.pdf', compact('rumahtangga'));
        return $pdf->download('formulir-06-rumahtangga-' . $rumahtangga->id . '.pdf');
    }    public function previewPdf($id)
    {
        $rumahtangga = Rumahtangga::with('bencana')->findOrFail($id);
        $pdf = PDF::loadView('forms.form6.pdf', compact('rumahtangga'));
        return $pdf->stream('formulir-06-rumahtangga-' . $rumahtangga->id . '.pdf');
    }
      /**
     * Get rumahtangga data via AJAX
     * 
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function getRumahtangga($id)
    {
        try {
            $rumahtangga = Rumahtangga::with('bencana')->findOrFail($id);
            
            // Render the view to a string
            $html = view('forms.form6.show', compact('rumahtangga'))->render();
            
            return response()->json([
                'success' => true,
                'html' => $html
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }
}
