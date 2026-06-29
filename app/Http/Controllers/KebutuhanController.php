<?php

namespace App\Http\Controllers;

use App\Models\Bencana;
use App\Models\LaporanBencana;
use App\Models\Formulir;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use App\Services\FormulirService;
use Log;

class KebutuhanController extends Controller
{
    public function __construct(
        private FormulirService $formulirService
    ) {}

   public function show($id)
{
        $formulir = $this->formulirService->loadFormulir($id);

        return view(
            'kebutuhan.show',
            $this->formulirService->getSummary($formulir)
        );
    }
    /**
     * Display a listing of the resource.
     */    
    public function index(Request $request)
    {
        $bencana_id = $request->input('bencana_id');
        $bencana = null;
        
        // Redirect to bencana selection page if no bencana_id is provided
        if (!$bencana_id) {
            return redirect()->route('bencana.index', ['source' => 'kebutuhan']);
        }
        
        // Get bencana details if ID is provided
        $bencana = Bencana::findOrFail($bencana_id);

        return view('kebutuhan.index', compact('bencana'));
    }

    /**
     * Display a summary of tables by form.
     */    
    public function listFormat(Request $request)
    {
        $bencana = Bencana::findOrFail($request->bencana_id);

        $summaries = $this->formulirService
        ->getSummaries($bencana);

        return view('kebutuhan.list', compact(
            'bencana',
            'summaries'
        ));
    }

}
