<?php

namespace App\Http\Controllers;

use App\Models\Desa;
use App\Models\Rekap;
use App\Models\Bencana;
use App\Models\Kecamatan;
use Illuminate\Http\Request;
use App\Models\KategoriBencana;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Intervention\Image\ImageManagerStatic as Image;

class BencanaController extends Controller
{
    
    public function index(Request $request)
    {
        $kategoriBencana = KategoriBencana::query()->get();
        $bencanaQuery = Bencana::query()->with('desa')->latest();
        if ($request->filled('kategori_bencana_id')) {
            $bencanaQuery->where('kategori_bencana_id', '=', $request->input('kategori_bencana_id'));
        }
        $bencana = $bencanaQuery->paginate($request->input('limit', 5))->appends($request->except('page'));
        
        // Check if the request is from the forms or kebutuhan module
        $source = $request->input('source');
        $isFromForms = $source === 'forms';
        $isFromKebutuhan = $source === 'kebutuhan';
        
        if ($isFromForms) {
            return view('bencana.form-select', [
                'bencana' => $bencana,
                'kategoribencana' => $kategoriBencana,
            ]);
        } elseif ($isFromKebutuhan) {
            return view('bencana.kebutuhan-select', [
                'bencana' => $bencana,
                'kategoribencana' => $kategoriBencana,
            ]);
        }

        return view('bencana.index', [
            'bencana' => $bencana,
            'kategoribencana' => $kategoriBencana,
        ]);
    }
    
    public function create()
    {
        $kategoriBencana = KategoriBencana::query()->get();
        return view('bencana.create', [
            'kategoribencana' => $kategoriBencana,
        ]);
    }

    public function getref()
    {
        // Ambil data terakhir dari tabel bencana
        $last = DB::table('bencana')->latest('id')->first();

        if ($last) {
            // Ambil referensi terakhir
            $item = $last->ref;
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

    public function store(Request $request)
    {
        // dd($request->all());
        try {
            DB::beginTransaction();
            $bencaRules = $request->validate([
                'kategori_bencana_id' => 'required',
                'tanggal' => 'required',
                'province_code' => 'required',
                'regency_code' => 'required',
                'district_code' => 'required',
                'village_code' => 'required',
                'deskripsi' => 'nullable',
                'gambar' => 'nullable',
            ]);
            //handle image
            if ($request->input('avatar') !== null) {

                $avatarBase64 = $request->input('avatar');

                $avatarBinaryData = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $avatarBase64));
                $filename = $request['name'] . '_' . uniqid() . '.png';

                $tempDir = public_path('/frontend/dist/assets/images/avatar/temp/');
                if (!file_exists($tempDir)) {
                    mkdir($tempDir, 0777, true);
                }

                $tempFilePath = public_path('/frontend/dist/assets/images/avatar/temp/' . $filename);
                file_put_contents($tempFilePath, $avatarBinaryData);

                $image_resize = Image::make($tempFilePath);
                $image_resize->resize(305, 305);
                $image_resize->save(public_path('/frontend/dist/assets/images/avatar/' . $filename));
                unlink($tempFilePath);
            } else {
                $filename = 'no-image.png';
            }
            $villageCode = is_array($bencaRules['village_code']) ? implode(',', $bencaRules['village_code']) : $bencaRules['village_code'];
            $bencana = Bencana::create([
                'ref' => $this->getref(),
                'kategori_bencana_id' => $bencaRules['kategori_bencana_id'],
                'tanggal' => $bencaRules['tanggal'],
                'province_code' => $bencaRules['province_code'],
                'regency_code' => $bencaRules['regency_code'],
                'district_code' => $bencaRules['district_code'],
                'village_code' => $villageCode,
                'deskripsi' => $bencaRules['deskripsi'],
                'gambar' => $filename,
            ]);

            Rekap::create([
                'id' => $bencana->id, // id rekap sama dengan id bencana
                'user_id' => auth()->id() ?? null,
                'bencana_id' => $bencana->id,
            ]);
            
            // dd($request->all());
            DB::commit();

            return redirect()->route('bencana.index')->with('success', 'Bencana Sukses Ditambahkan');
            // } catch (\Throwable $th) {
            //     DB::rollBack();
            //     // Menyimpan error ke log dan mengembalikan ke halaman sebelumnya dengan error message
            //     Log::error('Error storing bencana: ' . $th->getMessage());

            //     return redirect()->back()->with('error', $th->getMessage());
            // }
        } catch (\Illuminate\Validation\ValidationException $e) {
            DB::rollBack();

            return redirect()->back()->withErrors($e->errors())->withInput();
        }

    }

    public function show(string $id)
    {
        $bencana = Bencana::with(['kerusakan.detail'])->findOrFail($id);

        // Hitung total jumlah kuantitas (bangunan rusak)
        $totalKuantitas = $bencana->kerusakan->sum('kuantitas');
        $totalBiayaPerbaikan = $bencana->kerusakan->sum('BiayaKeseluruhan');
        $totalKerugian = $bencana->kerugian->sum('BiayaKeseluruhan');
        $kebutuhan = $totalBiayaPerbaikan + $totalKerugian;
        // dd($kebutuhan);
        return view('bencana.show', [
            'bencana' => $bencana,
            'totalKuantitas' => $totalKuantitas,
            'totalBiayaPerbaikan' => $totalBiayaPerbaikan,
            'totalKerugian' => $totalKerugian,
            'kebutuhan' => $kebutuhan,
        ]);
        
        dd($request->latitude, $request->longitude);
        
    }

    public function edit($id)
    {
        $bencana = Bencana::findOrFail($id);
        $kategoriBencana = KategoriBencana::all();
        return view('bencana.edit', [
            'bencana' => $bencana,
            'kategoribencana' => $kategoriBencana,
        ]);
    }

    public function update(Request $request, $id)
    {
        try {
            DB::beginTransaction();

            $bencana = Bencana::findOrFail($id);

            $bencaRules = $request->validate([
                'ref' => $this->getref(),
                'kategori_bencana_id' => $bencaRules['kategori_bencana_id'],
                'tanggal' => $bencaRules['tanggal'],
                'province_code' => $bencaRules['province_code'],
                'regency_code' => $bencaRules['regency_code'],
                'district_code' => $bencaRules['district_code'],
                'village_code' => $bencaRules['village_code'],
                'deskripsi' => $bencaRules['deskripsi'],
                'gambar' => $filename,
            ]);
            $currentAvatar = $bencana->gambar ?? 'no-image.png';
            if ($request->avatar != null) {

                $avatarBase64 = $request->input('avatar');

                $avatarBinaryData = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $avatarBase64));
                $filename = $request['name'] . '_' . uniqid() . '.png';

                $tempFilePath = public_path('/frontend/dist/assets/images/avatar/temp/' . $filename);
                file_put_contents($tempFilePath, $avatarBinaryData);

                $image_resize = Image::make($tempFilePath);
                $image_resize->resize(305, 305);
                $image_resize->save(public_path('/frontend/dist/assets/images/avatar/' . $filename));
                unlink($tempFilePath);

                $path = public_path('/frontend/dist/assets/images/avatar/');
                $currentPhotoPath = $path . $currentAvatar;
                if (file_exists($currentPhotoPath)) {
                    if ($currentAvatar != 'no-image.png') {
                        @unlink($currentPhotoPath);
                    }
                }
            } else {
                $filename = $currentAvatar;
            }
            $bencana->update([
                'ref' => $this->getref(),
                'kategori_bencana_id' => $bencaRules['kategori_bencana_id'],
                'tanggal' => $bencaRules['tanggal'],
                'province_code' => $bencaRules['province_code'],
                'regency_code' => $bencaRules['regency_code'],
                'district_code' => $bencaRules['district_code'],
                'village_code' => $bencaRules['village_code'],
                'deskripsi' => $bencaRules['deskripsi'],
                'gambar' => $filename,
            ]);

            DB::commit();

            return redirect()->route('bencana.index')->with('success', 'Data bencana berhasil diperbarui');
        } catch (\Throwable $th) {
            DB::rollBack();
            Log::error('Error updating bencana: ' . $th->getMessage());
            return redirect()->back()->withErrors('Terjadi kesalahan, silakan coba lagi.');
        }
    }

    public function formLanjutan($id)
    {
        return redirect()->route('forms.index', ['bencana_id' => $id]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
