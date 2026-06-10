<?php

namespace App\Observers;

use App\Models\Bencana;
use App\Models\LaporanBencana;

class BencanaObserver
{
    /**
     * Handle the Bencana "created" event.
     */
        
    public function created(Bencana $bencana)
    {
        LaporanBencana::create([
            'user_id' => auth()->id() ?? 1,
            'bencana_id' => $bencana->id,
            'tanggal_lapor' => now(),
            'status_laporan' => 'draft',
            'total_kerusakan' => 0,
            'total_kerugian' => 0,
        ]);
    }
    

    /**
     * Handle the Bencana "updated" event.
     */
    public function updated(Bencana $bencana): void
    {
        //
    }

    /**
     * Handle the Bencana "deleted" event.
     */
    public function deleted(Bencana $bencana): void
    {
        //
    }

    /**
     * Handle the Bencana "restored" event.
     */
    public function restored(Bencana $bencana): void
    {
        //
    }

    /**
     * Handle the Bencana "force deleted" event.
     */
    public function forceDeleted(Bencana $bencana): void
    {
        //
    }
}
