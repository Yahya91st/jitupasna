<?php

namespace App\Http\Controllers;

use App\Models\Bencana;
use App\Models\KategoriBangunan;
use App\Models\KategoriBencana;
use App\Models\Kerugian;
use App\Models\Satuan;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class KerugianController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // $kategoriBangunan = KategoriBangunan::query()->get();
        $kerugian = Kerugian::query()->with(['bencana'])->latest()->paginate(5);

        return view('kerugian.index', [
            'kerugian' => $kerugian,
        ]);
    }
    
    /**
     * Display a list of disasters for kerugian view
     */
    public function list(Request $request)
    {
        $kategoriBencana = KategoriBencana::query()->get();
        $bencanaQuery = Bencana::query()->with('desa')->with('kategori_bencana')->latest();
        
        if ($request->filled('kategori_bencana_id')) {
            $bencanaQuery->where('kategori_bencana_id', '=', $request->input('kategori_bencana_id'));
        }
        
        $bencana = $bencanaQuery->paginate($request->input('limit', 5))->appends($request->except('page'));

        return view('kerugian.list', [
            'bencana' => $bencana,
            'kategoribencana' => $kategoriBencana,
        ]);
    }
    
    /**
     * Display details of kerugian for a specific bencana
     */
    public function detail($id)
    {
        // Get bencana information
        $bencana = Bencana::with(['kategori_bencana', 'desa'])->findOrFail($id);
        
        // Get all kerugian data for this bencana
        $kerugianData = Kerugian::where('bencana_id', $id)
            ->with(['satuan'])
            ->get();
            
        // Calculate total kerugian
        $totalKerugian = $kerugianData->sum('BiayaKeseluruhan');
        
        // Count number of sectors
        $jumlahSektor = $kerugianData->groupBy('tipe')->count();
        
        // Group by sector
        $sektorMapping = [
            1 => 'Pariwisata',
            2 => 'Pertanian',
            3 => 'Transportasi',
            0 => 'Lainnya'
        ];
        
        $kerugianBySektor = $kerugianData->groupBy('tipe')
            ->map(function($group, $key) use ($sektorMapping) {
                $sektorName = $sektorMapping[$key] ?? 'Lainnya';
                return [
                    'name' => $sektorName,
                    'value' => $group->sum('BiayaKeseluruhan')
                ];
            })
            ->pluck('value', 'name');
        
        return view('kerugian.detail', [
            'bencana' => $bencana,
            'kerugianData' => $kerugianData,
            'totalKerugian' => $totalKerugian,
            'jumlahSektor' => $jumlahSektor,
            'kerugianBySektor' => $kerugianBySektor
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($id)
    {
        $bencana = Bencana::where('id', $id)->with(['kategori_bencana', 'desa'])->first();
        $tglMulai = Carbon::parse($bencana->tgl_mulai);
        $tglSelesai = Carbon::parse($bencana->tgl_selesai);
        $jumlahHari = $tglMulai->diffInDays($tglSelesai);
        $satuan = Satuan::query()->get();

        return view('kerugian.create', [
            // 'kategoribangunan' => $kategoriBangunan,
            'bencana' => $bencana,
            'jumlahHari' => $jumlahHari, // Kirim jumlah hari ke view
            'satuan' => $satuan,
        ]);
    }
    public function getRef()
    {
        // Ambil data terakhir dari tabel bencana
        $last = DB::table('kerugian')->latest('id')->first();

        if ($last) {
            // Ambil referensi terakhir
            $item = $last->Ref;
            // Konversi nomor terakhir menjadi integer dan tambahkan 1
            $nextNumber = intval($item) + 1;
            // Format nomor dengan nol di depan, menjadi tiga digit
            $code = str_pad($nextNumber, 3, '0', STR_PAD_LEFT);
        } else {
            // Jika tidak ada data, mulai dari 001
            $code = '001';
        }

        return $code;
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $id)
    {
        // dd($request->all());
        $bencana = Bencana::where('id', $id)->first();
        try {
            DB::beginTransaction();
            $request->validate([
                'details.*.tipe' => 'required',
                'details.*.nilai_ekonomi' => 'required',
                'details.*.satuan_id' => 'required',
                'details.*.kuantitas' => 'required',
                'details.*.deskripsi' => 'nullable',
            ]);

            // Mengambil data bencana_id dari request
            $bencana_id = $bencana->id;

            // Loop melalui setiap detail kerugian yang ada
            foreach ($request->details as $detail) {
                $nilai_ekonomi_asli = $detail['nilai_ekonomi_hidden'];
                $biayaKeseluruhan = $detail['kuantitas'] * $nilai_ekonomi_asli;

                // Buat record kerugian baru di database
                Kerugian::create([
                    'Ref' => $this->getRef(),
                    'bencana_id' => $bencana_id,
                    'tipe' => $detail['tipe'],
                    'nilai_ekonomi' => $nilai_ekonomi_asli,
                    'satuan_id' => $detail['satuan_id'],
                    'kuantitas' => $detail['kuantitas'],
                    'deskripsi' => $detail['deskripsi'] ?? null,
                    'created_at' => now(),
                    'BiayaKeseluruhan' => $biayaKeseluruhan,

                ]);
            }
            DB::commit();
            // Redirect ke halaman yang sesuai setelah penyimpanan sukses
            return redirect()->route('kerugian.index')->with('success', 'Data kerugian berhasil disimpan.');
        } catch (\Illuminate\Validation\ValidationException $e) {
            DB::rollBack();

            return redirect()->back()->withErrors($e->errors())->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $kerugian = Kerugian::with(['bencana', 'satuan'])
            ->findOrFail($id);
            
        // Calculate totals
        $totalBiaya = $kerugian->BiayaKeseluruhan ?? 0;
        
        return view('kerugian.show', [
            'kerugian' => $kerugian,
            'totalBiaya' => $totalBiaya,
            'bencana' => $kerugian->bencana
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $kerugian = Kerugian::where('id', $id)->with(['bencana'])->first();
        $bencana = Bencana::where('id', $kerugian->bencana_id)->with(['kategori_bencana','desa'])->first();
        $satuan = Satuan::query()->get();

        return view('kerugian.edit', [
            'kerugian' => $kerugian,
            'satuan' => $satuan,
            'bencana' => $bencana,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            DB::beginTransaction();
            // Validasi input
            $request->validate([
                'tipe' => 'required',
                'nilai_ekonomi' => 'required',
                'satuan_id' => 'required',
                'kuantitas' => 'required',
                'deskripsi' => 'nullable',
            ]);

            // Temukan model Kerugian berdasarkan id
            $kerugian = Kerugian::findOrFail($id);
            // Perbarui data Kerugian
            $kerugian->tipe = $request->input('tipe');
            $kerugian->nilai_ekonomi = $request->input('nilai_ekonomi_hidden');
            $kerugian->satuan_id = $request->input('satuan_id');
            $kerugian->kuantitas = $request->input('kuantitas');
            $kerugian->deskripsi = $request->input('deskripsi');
            $biayaKeseluruhan = $request->input('kuantitas') * $request->input('nilai_ekonomi_hidden');
            $kerugian->BiayaKeseluruhan = $biayaKeseluruhan;
            $kerugian->save();
            DB::commit();
            return redirect()->route('kerugian.index')->with('success', 'Data kerugian berhasil diperbarui');
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back()->with('error', $th->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
