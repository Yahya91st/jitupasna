<?php

namespace App\Services;

use App\Models\Formulir;
use App\Models\FormulirItem;
use App\Models\Bencana;
use App\Models\LaporanBencana;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;

class FormulirService
{
    public function loadVillages(Bencana $bencana): void
    {
        $codes = is_array($bencana->village_codes)
            ? $bencana->village_codes
            : json_decode($bencana->village_codes, true);

        $bencana->villages = collect($codes)->map(function ($code) {

            $parts = explode('.', $code);
            $districtCode = implode('.', array_slice($parts, 0, 3));

            $response = Http::get("https://wilayah.id/api/villages/{$districtCode}.json");

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
                'name' => $village['name'] ?? '-',
            ];
        })->toArray();
    }

    public function getSummaries(Bencana $bencana): array
    {
        $laporan = LaporanBencana::where('bencana_id', $bencana->id)
            ->first();

        if (!$laporan) {
            return [];
        }

        $formats = Formulir::with('items')
            ->where('laporan_id', $laporan->id)
            ->get();

        $summaries = [];

        foreach ($formats as $formulir) {

            $totals = $this->computeTotals($formulir);

            $summaries[] = [
                'id' => $formulir->id,
                'nama_kampung' => $formulir->nama_kampung,
                'nama_distrik' => $formulir->nama_distrik,
                'format' => sprintf('Format/Sektor %02d', $formulir->format_id),
                'total_kerusakan' => $totals['total_kerusakan'],
                'total_kerugian' => $totals['total_kerugian'],
            ];
        }

        return $summaries;
    }

    public function getSummary(Formulir $formulir): array
    {
        $rows = $this->buildItemRows($formulir);
        $totals = $this->computeTotals($formulir);

        return [
            'rows' => $rows,
            'totals' => $totals,
        ];
    }

    public function loadFormulir(int $id): Formulir
    {
        return Formulir::with(['laporan.bencana', 'items'])->findOrFail($id);
    }

    public function computeTotals(Formulir $formulir): array
    {
        $totalKerusakan = 0;
        $totalKerugian = 0;

        foreach ($formulir->items as $item) {

            $subtotal =
                (float)$item->jumlah *
                (float)$item->harga_satuan;

            if (in_array($item->kategori, [
                'rumah',
                'jalan',
                'saluran',
                'balai'
            ], true)) {

                $totalKerusakan += $subtotal;
            } else {

                $totalKerugian += $subtotal;
            }
        }

        return [
            'total_kerusakan'   => $totalKerusakan,
            'total_kerugian'    => $totalKerugian,
            'total_keseluruhan' => $totalKerusakan + $totalKerugian,
        ];
    }

    public function buildItemRows(Formulir $formulir): array
    {
        return $formulir->items
            ->map(function (FormulirItem $item) {

                return [
                    'id' => $item->id,
                    'kategori' => $item->kategori,
                    'sub_kategori' => $item->sub_kategori,
                    'tingkat_kerusakan' => $item->tingkat_kerusakan,
                    'jumlah' => $item->jumlah,
                    'harga_satuan' => $item->harga_satuan,
                    'satuan' => $item->satuan,
                    'subtotal' =>
                    (float)$item->jumlah *
                        (float)$item->harga_satuan,
                ];
            })
            ->values()
            ->all();
    }
}
