<?php
namespace App\Http\Controllers;

use App\Models\Bencana;
use App\Models\Form1;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Barryvdh\DomPDF\Facade\Pdf;

class Form1ControllerNew extends Controller
{
    public function index(Request $request)
    {
        $bencana_id = $request->input(key: 'bencana_id');

        if (!$bencana_id) {
            return redirect()->route('bencana.index', ['source'=>'forms']);
        }
        $bencana=Bencana::findOrFail($bencana_id);

        return view('forms.form1.form1', compact('bencana'));
    }

    //fungsi untuk mengirimkan data
    public function store(Request $request)
    {
        // Data yang perlu dikirim ke controller
        $validator = Validator::make($request->all(),[
            'bencana_id'=>'required|exists:bencana_id',
            'kop_surat'=>'required|string|max:100',
            'nomor_surat'=>'required|string|max:50',
            'nomor_surat_date'=>'required|date',
            'sifat'=>'required|in:Segera,Biasa,Rahasia',
            'lampiran'=>'nullable|integer|min:0',
            'kepada_jabatan'=>'required|string|max:100',
            'lokasi_pdna'=>'required|string|max:150',
            'hari_tanggal'=>'required|date',
            'waktu'=>'required|string|max:30',
            'tempat'=>'required|string|max:150',
            'agenda'=>'required|string|max:255',
            'nama_penandatangan'=>'required|string|max:100',
            'tembusan'=>'required|string|max:255'
        ]);

        //jika gagal mengirim data, itu berarti 
        //validatornya mendeteksi ada yang salah pada 
        //data yang kamu kirim 

        if ($validator->fails()) {
            return redirect()->back()
            ->withErrors($validator)
            ->withInput();
        }


        //jika validator tidak mendeteksi error pada datamu
        //maka variabel $form akan dibuat untuk menampung
        //data dari $request atau data yang kamu kirim
        $form=Form1::create($request->all());

        //lalu kamu pun dipindahkan ke view show
        return redirect()->route('forms.form1.show',$form->id)
        ->with('success', 'formulir berhasil disimpan');
    }

    public function list(Request $request)
    {
        $bencana_id=$request->input('bencana_id');
        if (!$bencana_id) {
            return redirect()->route('bencana.index'. ['source'=>'forms']);
        }
        $bencana=Bencana::findOrFail($bencana_id);

        //mencari lalu memilih data dari form1 yang punya 
        //$bencana_id yang sama dan diurutkan dari yang paling baru
         $form=Form1::where('bencana_id',$bencana_id)->latest()->get();
        
        return view('forms.form1.list',compact('bencana', ' form'));
    }

    //fungsi untuk menampilkan view show
    public function show($id)
    {
        $form=Form1::with(['bencana'])->findOrFail($id);
        return view('forms.form1.show', compact('form1'));
    }


    //aku tidak terlalu tahu $id ini, mungkin terfokus ke 1  form
    public function generatePDF($id) 
    {
        //mencari data yang dikirim menggunakan id
        $form=Form1::with(['bencana'])->findOrFail($id);
        //variabel untuk membuat view khusus pdf
        $pdf=Pdf::loadView('forms.form1.pdf',compact('form'));
        //menamai file pdf yang akan didownload nanti
        return $pdf->download('_Formulir_01_pdna_' . $form->id . '.pdf');
    }

    //untuk preview pdf tanpa perlu download terlebih dahulu
    public function previewPDF($id) 
    {
        $form=Form1::with(['bencana'])->findOrFail($id);
        if (!empty($form->tanggal_surat) && !$form->tanggal_surat instanceof \Carbon\Carbon) {
            $form->tanggal_surat=\Carbon\Carbon::parse($form->tanggal_surat);
        }
        if (!empty($form->hari_tanggal) && !$form->hari_tanggal instanceof \Carbon\Carbon) {
            $form->hari_tanggal=\Carbon\Carbon::parse($form->hari_tanggal);
        }
        if (!empty($form->bencana->tanggal) && !$form->bencana->tanggal instanceof \Carbon\Carbon) {
            $form->bencana->tanggal=\Carbon\Carbon::parse($form->bencana->tanggal);
        }
        $pdf=Pdf::loadView('forms.form1.pdf');
        return $pdf->stream('_Formulir_01_pdna_' . $form->id . '.pdf');
    }

    public function edit($id) 
    {
        try {
            $form=Form1::findOrFail($id);
            $bencana=Bencana::find($form->bencana_id);
        } catch (\Exception $e) {
            return back()->with('error','Data formulir tidak ditemukan.');
        }

    }
    
    public function update(Request $request, $id) 
    {
        try {
            $form=Form1::findOrFail($id);
            $validator=Validator::make($request->all(),[
            'kop_surat'=>'required|string|max:100',
            'nomor_surat'=>'required|string|max:50',
            'nomor_surat_date'=>'required|date',
            'sifat'=>'required|in:Segera,Biasa,Rahasia',
            'lampiran'=>'nullable|integer|min:0',
            'kepada_jabatan'=>'required|string|max:100',
            'lokasi_pdna'=>'required|string|max:150',
            'hari_tanggal'=>'required|date',
            'waktu'=>'required|string|max:30',
            'tempat'=>'required|string|max:150',
            'agenda'=>'required|string|max:255',
            'nama_penandatangan'=>'required|string|max:100',
            'tembusan'=>'required|string|max:255'
            ]);
        if ($validator->fails()) {
            return redirect()->back()
            ->withErrors($validator)
            ->withInput();
        }
        $form->update($request->all());
        return redirect()->route('forms.form1.show', $form->id)
        -with('success','Formulir berhasil diperbarui.');
        } catch (\Exception $e) {
            return back()->withInput()->with('error','Terjadi kesalahan: ' . $e->getMessage());
        }        
    } 

    public function destroy($id)
    {
        try {
            $form = Form1::findOrFail($id);
            $bencana_id = $form->bencana_id;
            $form->delete();
            
            return redirect()->route('forms.form.list', ['bencana_id' => $bencana_id])
                ->with('success', 'Data Form 6 berhasil dihapus');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

}


