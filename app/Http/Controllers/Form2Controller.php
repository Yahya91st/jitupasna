<?php

namespace App\Http\Controllers;

use App\Models\Bencana;
use App\Models\Keputusan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Barryvdh\DomPDF\Facade\Pdf;

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
        try {
            $validated = $request->validate([
                'nomor_surat' => 'required|string|max:255|unique:keputusan,nomor_surat',
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
                'bencana_id' => 'required|exists:bencana,id'
            ]);

            // Combine menimbang and mengingat to create dasar_hukum field
            $dasar_hukum = "Menimbang:\n{$validated['menimbang']}\n\nMengingat:\n{$validated['mengingat']}";
            
            // Structure the keputusan content
            $keputusan = "KESATU: Membentuk Tim Kerja Pengkajian Kebutuhan Pascabencana dengan susunan tim sebagai berikut:\n{$validated['tim_kerja']}\n\n";
            $keputusan .= "KEDUA: Tim sebagaimana dimaksud dalam Diktum KESATU mempunyai tugas sebagai berikut:\n{$validated['tugas_tim']}\n\n";
            $keputusan .= "KETIGA: Dalam melaksanakan tugasnya, Tim bertanggung jawab kepada {$validated['penanggung_jawab']}.\n\n";
            $keputusan .= "KEEMPAT: Keputusan ini mulai berlaku pada tanggal ditetapkan.";
            
            // Create new keputusan record
            $keputusanData = new Keputusan();
            $keputusanData->nomor_surat = $validated['nomor_surat'];
            $keputusanData->tentang = $validated['tentang'];
            $keputusanData->lokasi = $validated['lokasi'];
            $keputusanData->tanggal_ditetapkan = $validated['tanggal_ditetapkan'];
            $keputusanData->pejabat_penandatangan = $validated['pejabat_penandatangan'];
            $keputusanData->dasar_hukum = $dasar_hukum;
            $keputusanData->keputusan = $keputusan;
            $keputusanData->tim_kerja = $validated['tim_kerja'];
            $keputusanData->tugas_tim = $validated['tugas_tim'];
            $keputusanData->penanggung_jawab = $validated['penanggung_jawab'];
            $keputusanData->tembusan = $validated['tembusan'];
            $keputusanData->bencana_id = $validated['bencana_id'];
            $keputusanData->created_by = Auth::id();
            $keputusanData->save();
            
            return redirect()->route('forms.form2.show', $keputusanData->id)
                ->with('success', 'Surat Keputusan berhasil dibuat.');
        } catch (\Exception $e) {
            Log::error('Error creating keputusan: ' . $e->getMessage());
            return back()->withInput()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
      /**
     * Display the specified Surat Keputusan.
     */
    public function show($id)
    {
        try {
            $keputusan = Keputusan::findOrFail($id);
            return view('forms.form2.form2-show', compact('keputusan'));
        } catch (\Exception $e) {
            return back()->with('error', 'Surat Keputusan tidak ditemukan.');
        }
    }
    
    /**
     * Show the form for editing the specified Surat Keputusan.
     */
    public function edit($id)
    {
        try {
            $keputusan = Keputusan::findOrFail($id);
            
            // Parse dasar_hukum back to menimbang and mengingat for form fields
            $dasar_hukum_parts = explode("Mengingat:", $keputusan->dasar_hukum);
            $menimbang = trim(str_replace("Menimbang:", "", $dasar_hukum_parts[0]));
            $mengingat = isset($dasar_hukum_parts[1]) ? trim($dasar_hukum_parts[1]) : "";
            
            return view('forms.form2.form2-edit', compact('keputusan', 'menimbang', 'mengingat'));
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
            $keputusan = Keputusan::findOrFail($id);
            
            $validated = $request->validate([
                'nomor_surat' => 'required|string|max:255|unique:keputusan,nomor_surat,' . $id,
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
            
            // Update keputusan record
            $keputusan->update([
                'nomor_surat' => $validated['nomor_surat'],
                'tentang' => $validated['tentang'],
                'lokasi' => $validated['lokasi'],
                'tanggal_ditetapkan' => $validated['tanggal_ditetapkan'],
                'pejabat_penandatangan' => $validated['pejabat_penandatangan'],
                'dasar_hukum' => $dasar_hukum,
                'keputusan' => $keputusan_content,
                'tim_kerja' => $validated['tim_kerja'],
                'tugas_tim' => $validated['tugas_tim'],
                'penanggung_jawab' => $validated['penanggung_jawab'],
                'tembusan' => $validated['tembusan'],
                'updated_by' => Auth::id()
            ]);
            
            return redirect()->route('forms.form2.show', $keputusan->id)
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
        $keputusan = Keputusan::join('bencana', 'keputusan.bencana_id', '=', 'bencana.id')
            ->select('keputusan.*', 'bencana.Ref as nama_bencana')
            ->orderBy('keputusan.created_at', 'desc')
            ->get();
            
        return view('forms.form2.form2-list', compact('keputusan'));
    }
    
    /**
     * Generate PDF document from Surat Keputusan.
     */
    public function generatePdf($id)
    {
        try {
            $keputusan = Keputusan::findOrFail($id);
            $bencana = Bencana::find($keputusan->bencana_id);
            
            $pdf = PDF::loadView('pdf.form2-pdf', compact('keputusan', 'bencana'));
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
            $keputusan = Keputusan::findOrFail($id);
            $bencana = Bencana::find($keputusan->bencana_id);
            
            $pdf = PDF::loadView('pdf.form2-pdf', compact('keputusan', 'bencana'));
            return $pdf->stream('SK_Tim_Kerja_' . $id . '.pdf');
        } catch (\Exception $e) {
            Log::error('Error previewing PDF: ' . $e->getMessage());
            return back()->with('error', 'Terjadi kesalahan saat menampilkan pratinjau PDF: ' . $e->getMessage());
        }
    }
}