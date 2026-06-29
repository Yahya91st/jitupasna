<?php

namespace App\Services;

use App\Models\Formulir;
use App\Models\FormulirItem;
use App\Models\Bencana;
use App\Models\LaporanBencana;


class FormulirService
{

    public function getSummaries(Bencana $bencana): array
    {
        $laporan = LaporanBencana::where('bencana_id', $bencana->id)
            ->first();
        // dd($laporan);

        if (!$laporan) {
            return [];
        }

        $formats = Formulir::with('items')
            ->where('laporan_id', $laporan->id)
            ->get();

        $summaries = [];

        foreach ($formats as $formulir) {

            $totals = $this->computeTotals($formulir, 1);

            $item = $formulir->items->first();

            $summaries[] = [
                'id' => $formulir->id,
                'nama_kampung' => $item?->nama_kampung,
                'nama_distrik' => $item?->nama_distrik,
                'format' => sprintf('Format/Sektor %02d', $formulir->format_id),
                'total_kerusakan' => $totals['total_kerusakan'],
                'total_kerugian' => $totals['total_kerugian'],
            ];
        }

        return $summaries;
    }
    public function getSummary(Formulir $formulir): array
    {
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
            ->map(function(FormulirItem $item){

                return [
                    'id'=>$item->id,
                    'kategori'=>$item->kategori,
                    'sub_kategori'=>$item->sub_kategori,
                    'tingkat_kerusakan'=>$item->tingkat_kerusakan,
                    'jumlah'=>$item->jumlah,
                    'harga_satuan'=>$item->harga_satuan,
                    'satuan'=>$item->satuan,
                    'subtotal'=>
                        (float)$item->jumlah *
                        (float)$item->harga_satuan,
                ];

            })
            ->values()
            ->all();
    }
}