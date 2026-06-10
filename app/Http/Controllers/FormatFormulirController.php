<?php

namespace App\Http\Controllers;



use App\Models\Bencana;
use Illuminate\Http\Request;
use App\Http\Requests\BencanaRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Intervention\Image\ImageManagerStatic as Image;
use Barryvdh\DomPDF\Facade\Pdf;
use Barryvdh\DomPDF\PDF as DomPdf;

class FormatFormulirController extends Controller
{
    public function index(Request $request)
    {
        $bencana_id = $request->input('bencana_id');

        if (!$bencana_id) {
            return redirect()->route('bencana.index', [
                'source' => 'forms'
            ]);
        }

        $bencana = Bencana::findOrFail($bencana_id);

        $codes = is_array($bencana->village_codes)
            ? $bencana->village_codes
            : json_decode($bencana->village_codes, true);

        $bencana->villages = collect($codes)->map(function ($code) {
            $code = trim($code);

            return Cache::remember("village_name_{$code}", 86400, function () use ($code) {

                $parts = explode('.', $code);
                $districtCode = implode('.', array_slice($parts, 0, 3));

                $response = Http::get(
                    "https://wilayah.id/api/villages/{$districtCode}.json"
                );

                if (!$response->ok()) {
                    return [
                        'code' => $code,
                        'name' => null,
                    ];
                }

                $village = collect($response->json('data'))
                    ->firstWhere('code', $code);

                return [
                    'code' => $code,
                    'name' => $village['name'] ?? null,
                ];
            });
        })->toArray();

        return view('forms.form4', compact('bencana'));
    }
}
