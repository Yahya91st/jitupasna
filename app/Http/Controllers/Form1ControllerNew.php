<?php
namespace App\Http\Controllers;

use App\Models\Bencana;
use App\Models\Form1;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Barryvdh\DomPDF\Facade\Pdf;

class Form1ControllerNew extends Controller
{
    public function index(Request $request): RedirectResponse|View
    {
        $bencana_id = $request->input(key: 'bencana_id');
    }
}


