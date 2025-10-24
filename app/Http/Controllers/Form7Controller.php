<?php

namespace App\Http\Controllers;

use App\Models\Bencana;
use App\Models\Form7;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Barryvdh\DomPDF\Facade\Pdf;

class Form7Controller extends Controller
{
    /**
     * Display the form for creating a new Form7.
     */
    public function index(Request $request)
    {
        $bencana_id = $request->query('bencana_id');
        $bencana = null;
        
        if ($bencana_id) {
            $bencana = Bencana::find($bencana_id);
        } else {
            $bencana = Bencana::all();
        }
        
        return view('forms.form7.form7', compact('bencana'));
    }
    
    /**
     * Store a newly created Form7 in database.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'bencana_id' => 'required|exists:bencana,id',
            'desa_kelurahan' => 'required|string|max:255',
            'kecamatan' => 'required|string|max:255',
            'kabupaten' => 'required|string|max:255',
            'tanggal' => 'required|date',
            'jarak_bencana' => 'required|integer|min:0',
            'tempat_sesi' => 'required|string|max:255',
            'jumlah_peserta' => 'required|integer|min:0',
            'jumlah_perempuan' => 'required|integer|min:0',
            'jumlah_laki_laki' => 'required|integer|min:0',
            'komposisi_peserta' => 'required|string',
            'fasilitator' => 'required|string|max:255',
            'pencatat' => 'required|string|max:255',
            
            // Checklist Persiapan
            'persiapan_pra_fgd' =>  'required|boolean',
            'pembagian_tugas_pelaksana' =>  'required|boolean',
            'perkenalan_pengantar' =>  'required|boolean',
            'pembahasan' =>  'required|boolean',
            'pendalaman_tanya_jawab' =>  'required|boolean',
            'penyimpulan_penutupan' =>  'required|boolean',

            // A. Akses Hak
            'akses_hak_bekerja' =>  'required|string',
            'akses_hak_jamsos' =>  'required|string',
            'akses_hak_perlindungan' =>  'required|string',
            'akses_hak_kesehatan' =>  'required|string',
            'akses_hak_pendidikan' =>  'required|string',

            // B. Fungsi Pranata
            'fungsi_pranata_sosial' =>  'required|string',
            'fungsi_pranata_ekonomi' =>  'required|string',
            'fungsi_pranata_agama' =>  'required|string',
            'fungsi_pranata_pemerintahan' =>  'required|string',

            // C. Resiko Kerentanan
            'resiko_kerentanan_sosial' =>  'required|string',
            'resiko_kerentanan_ekonomi' =>  'required|string',
            'resiko_kerentanan_geografis' =>  'required|string',

        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        
        $form = new Form7();
        $form->bencana_id = $request->bencana_id;
        $form->desa_kelurahan = $request->desa_kelurahan;
        $form->kecamatan = $request->kecamatan;
        $form->kabupaten = $request->kabupaten;
        $form->tanggal = $request->tanggal;
        $form->jarak_bencana = $request->jarak_bencana;
        $form->tempat_sesi = $request->tempat_sesi;
        $form->jumlah_peserta = $request->jumlah_peserta;
        $form->jumlah_perempuan = $request->jumlah_perempuan;
        $form->jumlah_laki_laki = $request->jumlah_laki_laki;
        $form->komposisi_peserta = $request->komposisi_peserta;
        $form->fasilitator = $request->fasilitator;
        $form->pencatat = $request->pencatat;

        $form->persiapan_pra_fgd = $request->persiapan_pra_fgd;
        $form->pembagian_tugas_pelaksana = $request->pembagian_tugas_pelaksana;
        $form->perkenalan_pengantar = $request->perkenalan_pengantar;
        $form->pembahasan = $request->pembahasan;
        $form->pendalaman_tanya_jawab = $request->pendalaman_tanya_jawab;
        $form->penyimpulan_penutupan = $request->penyimpulan_penutupan;

        // Diskusi
        $form->akses_hak_bekerja = $request->akses_hak_bekerja;
        $form->akses_hak_jamsos = $request->akses_hak_jamsos;
        $form->akses_hak_perlindungan = $request->akses_hak_perlindungan;
        $form->akses_hak_kesehatan = $request->akses_hak_kesehatan;
        $form->akses_hak_pendidikan = $request->akses_hak_pendidikan;

        $form->fungsi_pranata_sosial = $request->fungsi_pranata_sosial;
        $form->fungsi_pranata_ekonomi = $request->fungsi_pranata_ekonomi;
        $form->fungsi_pranata_agama = $request->fungsi_pranata_agama;
        $form->fungsi_pranata_pemerintahan = $request->fungsi_pranata_pemerintahan;

        $form->resiko_kerentanan_sosial = $request->resiko_kerentanan_sosial;
        $form->resiko_kerentanan_ekonomi = $request->resiko_kerentanan_ekonomi;
        $form->resiko_kerentanan_geografis = $request->resiko_kerentanan_geografis;

        $form->save();

        return redirect()->route('forms.form7.show', $form->id)->with('success', 'Data Form7 berhasil disimpan.');
    }
    
    /**
     * Display the specified Form7.
     */
    public function show($id)
    {
        $form = Form7::with('bencana')->findOrFail($id);
        return view('forms.form7.show', compact('form'));
    }
    
    /**
     * Display a listing of Form7.
     */
    public function list(Request $request)
    {
        $bencana_id = $request->input('bencana_id');
        
        if (!$bencana_id) {
            return redirect()->route('bencana.index', ['source' => 'forms']);
        }
        
        $bencana = Bencana::findOrFail($bencana_id);
        $form = Form7::where('bencana_id', $bencana_id)->latest()->get();
        
        return view('forms.form7.list', compact('bencana', 'form'));
    }

    /**
     * Generate PDF document from Form7.
     */
    public function generatePdf($id)
    {
        $form = Form7::with('bencana')->findOrFail($id);
        $pdf = PDF::loadView('forms.Form7.pdf', compact('form'));
        return $pdf->download('formulir-07-Form7-' . $form->id . '.pdf');
    }
    
    /**
     * Preview PDF document from Form7.
     */
    public function previewPdf($id)
    {
        $form = Form7::with('bencana')->findOrFail($id);
        return view('forms.Form7.pdf', compact('form'));
    }
    
    /**
     * Show the form for editing the specified Form7.
     */
    public function edit($id)
    {
        $form = Form7::findOrFail($id);
        $bencana = Bencana::all();
        return view('forms.form7.edit', compact('form', 'bencana'));
    }
    
    /**
     * Update the specified Form7 in database.
     */
    public function update(Request $request, $id)
    {
        $form = Form7::findOrFail($id);
        
        $validator = Validator::make($request->all(), [
            'bencana_id' => 'required|exists:bencana,id',
            'desa_kelurahan' => 'required|string|max:255',
            'kecamatan' => 'required|string|max:255',
            'kabupaten' => 'required|string|max:255',
            'tanggal' => 'required|date',
            'jarak_bencana' => 'required|integer|min:0',
            'tempat_sesi' => 'required|string|max:255',
            'jumlah_peserta' => 'required|integer|min:1',
            'jumlah_perempuan' => 'required|integer|min:0',
            'jumlah_laki_laki' => 'required|integer|min:0',
            'komposisi_peserta' => 'required|string',
            'fasilitator' => 'required|string|max:255',
            'pencatat' => 'required|string|max:255',

            // Checklist Persiapan
            'persiapan_pra_fgd' =>  'required|boolean',
            'pembagian_tugas_pelaksana' =>  'required|boolean',
            'perkenalan_pengantar' =>  'required|boolean',
            'pembahasan' =>  'required|boolean',
            'pendalaman_tanya_jawab' =>  'required|boolean',
            'penyimpulan_penutupan' =>  'required|boolean',

            // A. Akses Hak
            'akses_hak_bekerja' =>  'required|string',
            'akses_hak_jamsos' =>  'required|string',
            'akses_hak_perlindungan' =>  'required|string',
            'akses_hak_kesehatan' =>  'required|string',
            'akses_hak_pendidikan' =>  'required|string',

            // B. Fungsi Pranata
            'fungsi_pranata_sosial' =>  'required|string',
            'fungsi_pranata_ekonomi' =>  'required|string',
            'fungsi_pranata_agama' =>  'required|string',
            'fungsi_pranata_pemerintahan' =>  'required|string',

            // C. Resiko Kerentanan
            'resiko_kerentanan_sosial' =>  'required|string',
            'resiko_kerentanan_ekonomi' =>  'required|string',
            'resiko_kerentanan_geografis' =>  'required|string',

        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        
        $form->bencana_id = $request->bencana_id;
        $form->desa_kelurahan = $request->desa_kelurahan;
        $form->kecamatan = $request->kecamatan;
        $form->kabupaten = $request->kabupaten;
        $form->tanggal = $request->tanggal;
        $form->jarak_bencana = $request->jarak_bencana;
        $form->tempat_sesi = $request->tempat_sesi;
        $form->jumlah_peserta = $request->jumlah_peserta;
        $form->jumlah_perempuan = $request->jumlah_perempuan;
        $form->jumlah_laki_laki = $request->jumlah_laki_laki;
        $form->komposisi_peserta = $request->komposisi_peserta;
        $form->fasilitator = $request->fasilitator;
        $form->pencatat = $request->pencatat;

        $form->persiapan_pra_fgd = $request->persiapan_pra_fgd;
        $form->pembagian_tugas_pelaksana = $request->pembagian_tugas_pelaksana;
        $form->perkenalan_pengantar = $request->perkenalan_pengantar;
        $form->pembahasan = $request->pembahasan;
        $form->pendalaman_tanya_jawab = $request->pendalaman_tanya_jawab;
        $form->penyimpulan_penutupan = $request->penyimpulan_penutupan;

        // Diskusi
        $form->akses_hak_bekerja = $request->akses_hak_bekerja;
        $form->akses_hak_jamsos = $request->akses_hak_jamsos;
        $form->akses_hak_perlindungan = $request->akses_hak_perlindungan;
        $form->akses_hak_kesehatan = $request->akses_hak_kesehatan;
        $form->akses_hak_pendidikan = $request->akses_hak_pendidikan;

        $form->fungsi_pranata_sosial = $request->fungsi_pranata_sosial;
        $form->fungsi_pranata_ekonomi = $request->fungsi_pranata_ekonomi;
        $form->fungsi_pranata_agama = $request->fungsi_pranata_agama;
        $form->fungsi_pranata_pemerintahan = $request->fungsi_pranata_pemerintahan;

        $form->resiko_kerentanan_sosial = $request->resiko_kerentanan_sosial;
        $form->resiko_kerentanan_ekonomi = $request->resiko_kerentanan_ekonomi;
        $form->resiko_kerentanan_geografis = $request->resiko_kerentanan_geografis;

        $form->updated_by = Auth::id();
        $form->save();

        return redirect()->route('forms.form7.show', $form->id)->with('success', 'Data Form7 berhasil diperbarui.');
    }
    
    
    
    
    /**
     * Remove the specified Form7 from storage.
     */
    

    public function destroy($id)
    {
        try {
            $form = Form7::findOrFail($id);
            $bencana_id = $form->bencana_id;
            $form->delete();
            
            return redirect()->route('forms.form7.list', ['bencana_id' => $bencana_id])
                ->with('success', 'Data Form 7 berhasil dihapus');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
    public function contohPdf()
    {
        // Data dummy untuk contoh formulir
    $form = (object) [
        'desa_kelurahan' => 'Sukamaju',
        'kecamatan' => 'Cianjur',
        'kabupaten' => 'Cianjur',
        'tanggal' => '2025-10-16',
        'jarak_bencana' => '3 km',
        'tempat_sesi' => 'Balai Desa Sukamaju',
        'desa_sesi' => 'Sukamaju',
        'kec_sesi' => 'Cianjur',
        'jumlah_peserta' => 15,
        'jumlah_perempuan' => 7,
        'jumlah_laki_laki' => 8,
        'komposisi_peserta' => 'Petani, Ibu Rumah Tangga, Guru, Tokoh Masyarakat, Pemuda',
        'fasilitator' => 'Budi Santoso',
        'pencatat' => 'Siti Nurhaliza',
        'paraf_fasilitator' => 'BS',
        'paraf_pencatat' => 'SN',
        'persiapan_pra_fgd' => true,
        'pembagian_tugas' => true,
        'koordinasi_pengantar' => true,
        'pembahasan' => true,
        'pendalaman_tanya_jawab' => false,
        'penyimpulan_penutupan' => true,

        ];
        
        $pdf = Pdf::loadView('forms.form7.contoh_form7_pdf', compact('form'));
        return $pdf->stream('Contoh_Formulir_07_PDNA.pdf');
    }
}
