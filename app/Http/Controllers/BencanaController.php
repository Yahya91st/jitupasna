<?php

namespace App\Http\Controllers;

use App\Models\Bencana;
use App\Models\LaporanBencana;
use Illuminate\Http\Request;
use App\Http\Requests\BencanaRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Intervention\Image\ImageManagerStatic as Image;

class BencanaController extends Controller
{
        
    public function index(Request $request)
    {
        $jenis_bencana = config('bencana');

        $bencanaQuery = Bencana::query()->latest('id');
        if ($request->filled('jenis_bencana')) {
            $bencanaQuery->where('jenis_bencana', '=', $request->input('jenis_bencana'));
        }

        $bencana = $bencanaQuery->paginate($request->input('limit', 5))->appends($request->except('page'));

        // Transform: resolve village codes → names
        $bencana->getCollection()->transform(function ($item) {
            $codes = is_array($item->village_codes)
                ? $item->village_codes
                : json_decode($item->village_codes, true);

            $item->villages = collect($codes)->map(function ($code) {
                $code = trim($code);

                return Cache::remember("village_name_{$code}", 86400, function () use ($code) {
                    $parts = explode('.', $code);
                    $districtCode = implode('.', array_slice($parts, 0, 3));

                    $response = Http::get("https://wilayah.id/api/villages/{$districtCode}.json");

                    if (!$response->ok()) return ['code' => $code, 'name' => null];

                    $village = collect($response->json('data'))->firstWhere('code', $code);

                    return [
                        'code' => $code,
                        'name' => $village['name'] ?? null,
                    ];
                });
            })->toArray();

            return $item; 
        });

        // Check source setelah $bencana sudah siap
        $source = $request->input('source');

        if ($source === 'forms') {
            return view('bencana.form-select', [
                'bencana' => $bencana,
                'jenis_bencana' => $jenis_bencana,
            ]);
        }

        if ($source === 'kebutuhan') {
            return view('bencana.kebutuhan-select', [
                'bencana' => $bencana,
                'jenis_bencana' => $jenis_bencana,
            ]);
        }

        return view('bencana.index', [
            'bencana' => $bencana,
            'jenis_bencana' => $jenis_bencana,
        ]);
    }
    
    public function create()
    {
        $villages = Cache::rememberForever('village_map', function () {
            return Http::get('https://wilayah.id/api/villages')->json();
        });
        
        $jenis_bencana = config('bencana');

        return view('bencana.create', [
            'jenis_bencana' => $jenis_bencana,
        ]);
    }

    public function store(BencanaRequest $request)
    {
        try {
            DB::beginTransaction();
            $bencaRules = $request->validated();

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
                $villageCodes = $bencaRules['village_codes'];
                $bencana = Bencana::create([
                'jenis_bencana' => $bencaRules['jenis_bencana'],
                'tanggal' => $bencaRules['tanggal'],
                'province_code' => $bencaRules['province_code'],
                'regency_code' => $bencaRules['regency_code'],
                'district_code' => $bencaRules['district_code'],
                'village_codes' => $villageCodes,
                'deskripsi' => $bencaRules['deskripsi'],
                'gambar' => $filename,
            ]);            
            
            // dd($request->all());
            DB::commit();

            return redirect()->route('bencana.index')->with('success', 'Bencana Sukses Ditambahkan');
            
            return redirect()->back()->with('error', $th->getMessage());
            // }
        } catch (\Illuminate\Validation\ValidationException $e) {
            DB::rollBack();

            return redirect()->back()->withErrors($e->errors())->withInput();
        }

        $laporan = LaporanBencana::firstOrCreate(
            [
                'bencana_id' => $request->bencana_id,
                'user_id' => auth()->id(),
            ],
            [
                'tanggal_lapor' => now()->toDateString(),
                'status' => 'draft',
            ]
        );

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

        // Resolve nama dari kode via API wilayah
        $kecamatan = Cache::remember("district_{$bencana->district_code}", 86400, function () use ($bencana) {
            $response = Http::get("https://wilayah.id/api/districts/{$bencana->regency_code}.json");
            return $response->ok() ? $response->json('data') : [];
        });

        $kabupaten = Cache::remember("regency_{$bencana->regency_code}", 86400, function () use ($bencana) {
            $response = Http::get("https://wilayah.id/api/regencies/{$bencana->province_code}.json");
            return $response->ok() ? $response->json('data') : [];
        });

        $provinsi = Cache::remember("provinces", 86400, function () {
            $response = Http::get("https://wilayah.id/api/provinces.json");
            return $response->ok() ? $response->json('data') : [];
        });

        return view('bencana.edit', [
            'bencana'        => $bencana,
            'jenis_bencana'  => config('bencana'),
            'selectedDesaIds' => is_array($bencana->village_codes) 
                ? $bencana->village_codes 
                : json_decode($bencana->village_codes, true) ?? [],            'kecamatan'      => $kecamatan,
            'kabupaten'      => $kabupaten,
            'provinsi'       => $provinsi,
        ]);
    }

    public function update(BencanaRequest $request, $id)
    {
        try {
            DB::beginTransaction();

            $bencana = Bencana::findOrFail($id);

            $bencaRules = $request->validated();

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
            // UPDATE
            $villageCodes = $bencaRules['village_codes'];

            $bencana->update([
                'jenis_bencana' => $bencaRules['jenis_bencana'],
                'tanggal'       => $bencaRules['tanggal'],
                'province_code' => $bencaRules['province_code'],
                'regency_code'  => $bencaRules['regency_code'],
                'district_code' => $bencaRules['district_code'],
                'village_codes' => $villageCodes,
                'deskripsi'     => $bencaRules['deskripsi'],
                'gambar'        => $filename,
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
