<?php

namespace App\Http\Controllers;

use App\Models\Form2;
use App\Models\Bencana;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class Form2Controller extends Controller
{    /**
     * Display the form for creating a new Surat Keputusan.
     */
    public function index(Request $request)
    {
        $bencana_id = $request->query('bencana_id');
        $bencana = null;
        
        if ($bencana_id) {
            $bencana = Bencana::find($bencana_id);
        }
        
        return view('forms.form2.form2', compact('bencana'));
    }
    
    /**
     * Store a newly created Surat Keputusan in database.
     */
            public function store(Request $request)
        {
            $validator = Validator::make($request->all(), [
                'bencana_id' => 'required|exists:bencana,id',
                'nomor_surat' => 'required|string|max:255|unique:form2,nomor_surat',
                'lokasi_menimbang' => 'required|string|max:255',
                'pejabat_keputusan' => 'required|string|max:255',
                'tempat_ditetapkan' => 'required|string|max:255',
                'tanggal_ditetapkan' => 'required|string|max:255',
                'nama_penandatangan' => 'required|string|max:255',
                'tembusan' => 'required|string',
            ]);

            if ($validator->fails()) {
                return redirect()->back()
                    ->withErrors($validator)
                    ->withInput();
            }

            $validated = $validator->validated();

            // Generate default values for required database fields
            $tentang = "PEMBENTUKAN TIM KERJA PENGKAJIAN KEBUTUHAN PASCA BENCANA (PDNA) DI " . strtoupper($validated['lokasi_menimbang']);

            $dasar_hukum = "Menimbang:\na. bahwa dalam rangka perencanaan rehabilitasi dan rekonstruksi pascabencana di {$validated['lokasi_menimbang']} perlu dilaksanakan pengkajian kebutuhan pascabencana.\nb. bahwa untuk melaksanakan pengkajian kebutuhan pasca bencana perlu dibentuk tim kerja pengkajian kebutuhan pascabencana.\nc. bahwa untuk maksud tersebut huruf b, perlu ditetapkan dengan keputusan {$validated['pejabat_keputusan']}\n\nMengingat:\na. Undang-Undang no. 24 tahun 2007 tentang Penanggulangan Bencana.\nb. Peraturan Pemerintah no. 21 tahun 2008 tentang Penyelenggaraan Penanggulangan Bencana.\nc. Peraturan Kepala BNPB no. 17 tahun 2010 tentang Pedoman Umum Rehabilitasi dan Rekonstruksi.";

            // $keputusan = "KESATU: Membentuk Tim Kerja Pengkajian Kebutuhan Pascabencana di {$validated['lokasi_menimbang']}, dengan susunan personil sebagaimana terdapat pada lampiran keputusan ini.\n\n";
            // $keputusan .= "KEDUA: Tim dimaksud diktum pertama mempunyai tugas sebagai berikut:\n1. Melakukan perencanaan dan persiapan pelaksanaan pengkajian kebutuhan pascabencana.\n2. Melakukan pengumpulan data.\n3. Melakukan pengolahan dan analisis data.\n4. Menyusun laporan pengkajian kebutuhan pascabencana.\n\n";
            // $keputusan .= "KETIGA: Tim Kerja dalam melaksanakan tugasnya bertanggung jawab kepada {$validated['pejabat_keputusan']}.\n\n";
            // $keputusan .= "KEEMPAT: Keputusan ini berlaku sejak tanggal ditetapkan, apabila dikemudian hari terdapat kekeliruan dalam penetapan ini akan diperbaiki sebagaimana mestinya.";

            // Create new form2 record
            $form2Data = new Form2();
            $form2Data->nomor_surat = $validated['nomor_surat'];
            $form2Data->tentang = $tentang;
            $form2Data->lokasi = $validated['lokasi_menimbang'];
            $form2Data->tanggal_ditetapkan = $validated['tanggal_ditetapkan'];
            $form2Data->tempat_ditetapkan = $validated['tempat_ditetapkan'];
            $form2Data->pejabat_penandatangan = $validated['pejabat_keputusan'];
            $form2Data->nama_penandatangan = $validated['nama_penandatangan'];
            $form2Data->dasar_hukum = $dasar_hukum;
            // $form2Data->keputusan = $keputusan;
            $form2Data->tim_kerja = "Tim akan ditentukan kemudian";
            $form2Data->tugas_tim = "Sesuai dengan diktum KEDUA";
            $form2Data->penanggung_jawab = $validated['pejabat_keputusan'];
            $form2Data->tembusan = $validated['tembusan'];
            $form2Data->bencana_id = $validated['bencana_id'];
            // $form2Data->created_by = Auth::id();
            $form2Data->save();

            return redirect()->route('forms.form2.show', $form2Data->id)
                ->with('success', 'Surat Keputusan berhasil dibuat.');
        }
            
    
      /**
     * Display the specified Surat Keputusan.
     */
    public function show($id)
    {
        {
            $form2Data = Form2::findOrFail($id);
            return view('forms.form2.form2-show', compact('form2Data'));
        }
    }
    
    /**
     * Show the form for editing the specified Surat Keputusan.
     */
    public function edit($id)
    {
        try {
            $form2 = Form2::findOrFail($id);
            
            // Parse dasar_hukum back to menimbang and mengingat for form fields
            $dasar_hukum_parts = explode("Mengingat:", $form2->dasar_hukum);
            $menimbang = trim(str_replace("Menimbang:", "", $dasar_hukum_parts[0]));
            $mengingat = isset($dasar_hukum_parts[1]) ? trim($dasar_hukum_parts[1]) : "";
            
            return view('forms.form2.form2-edit', compact('form2', 'menimbang', 'mengingat'));
        } catch (\Exception $e) {
            return back()->with('error', 'Surat Keputusan tidak ditemukan.');
        }
    }
    
    /**
     * Update the specified Surat Keputusan in database.
     */
    public function update(Request $request, $id)
    {
        try {
            $form2 = Form2::findOrFail($id);
            
            $validated = $request->validate([
                'nomor_surat' => 'required|string|max:255|unique:form2,nomor_surat,' . $id,
                'tentang' => 'required|string|max:255',
                'lokasi' => 'required|string|max:255',
                'tanggal_ditetapkan' => 'required|date',
                'pejabat_penandatangan' => 'required|string|max:255',
                'menimbang' => 'required|string',
                'mengingat' => 'required|string',
                'tim_kerja' => 'required|string',
                'tugas_tim' => 'required|string',
                'penanggung_jawab' => 'required|string|max:255',
                'tembusan' => 'required|string',
            ]);

            // Combine menimbang and mengingat to update dasar_hukum field
            $dasar_hukum = "Menimbang:\n{$validated['menimbang']}\n\nMengingat:\n{$validated['mengingat']}";
            
            // Update the keputusan content
            $keputusan_content = "KESATU: Membentuk Tim Kerja Pengkajian Kebutuhan Pascabencana dengan susunan tim sebagai berikut:\n{$validated['tim_kerja']}\n\n";
            $keputusan_content .= "KEDUA: Tim sebagaimana dimaksud dalam Diktum KESATU mempunyai tugas sebagai berikut:\n{$validated['tugas_tim']}\n\n";
            $keputusan_content .= "KETIGA: Dalam melaksanakan tugasnya, Tim bertanggung jawab kepada {$validated['penanggung_jawab']}.\n\n";
            $keputusan_content .= "KEEMPAT: Keputusan ini mulai berlaku pada tanggal ditetapkan.";
            
            // Update form2 record
            $form2->update([
                'nomor_surat' => $validated['nomor_surat'],
                'tentang' => $validated['tentang'],
                'lokasi' => $validated['lokasi'],
                'tanggal_ditetapkan' => $validated['tanggal_ditetapkan'],
                'pejabat_penandatangan' => $validated['pejabat_penandatangan'],
                'dasar_hukum' => $dasar_hukum,
                // 'keputusan' => $keputusan_content,
                'tim_kerja' => $validated['tim_kerja'],
                'tugas_tim' => $validated['tugas_tim'],
                'penanggung_jawab' => $validated['penanggung_jawab'],
                'tembusan' => $validated['tembusan'],
                'updated_by' => Auth::id()
            ]);
            
            return redirect()->route('forms.form2.show', $form2->id)
                ->with('success', 'Surat Keputusan berhasil diperbarui.');
        } catch (\Exception $e) {
            Log::error('Error updating keputusan: ' . $e->getMessage());
            return back()->withInput()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
    
    /**
     * Display a listing of Surat Keputusan.
     */    public function listForm2()
    {
        $form2 = Form2::join('bencana', 'form2.bencana_id', '=', 'bencana.id')
            ->select('form2.*', 'bencana.Ref as nama_bencana')
            ->orderBy('form2.created_at', 'desc')
            ->get();
            
        return view('forms.form2.form2-list', compact('form2'));
    }
    
    /**
     * Generate PDF document from Surat Keputusan.
     */
    public function generatePdf($id)
    {
        try {
            $form2 = Form2::findOrFail($id);
            $bencana = Bencana::find($form2->bencana_id);
            
            $pdf = PDF::loadView('pdf.form2-pdf', compact('form2', 'bencana'));
            return $pdf->download('SK_Tim_Kerja_' . $id . '.pdf');
        } catch (\Exception $e) {
            Log::error('Error generating PDF: ' . $e->getMessage());
            return back()->with('error', 'Terjadi kesalahan saat mengunduh PDF: ' . $e->getMessage());
        }
    }
    
    /**
     * Preview PDF document from Surat Keputusan.
     */
    public function previewPdf($id)
    {
        try {
            $form2 = Form2::findOrFail($id);
            $bencana = Bencana::find($form2->bencana_id);
            
            $pdf = PDF::loadView('pdf.form2-pdf', compact('form2', 'bencana'));
            return $pdf->stream('SK_Tim_Kerja_' . $id . '.pdf');
        } catch (\Exception $e) {
            Log::error('Error previewing PDF: ' . $e->getMessage());
            return back()->with('error', 'Terjadi kesalahan saat menampilkan pratinjau PDF: ' . $e->getMessage());
        }
    }
}