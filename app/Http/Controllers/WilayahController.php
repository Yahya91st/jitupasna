<?php
namespace App\Http\Controllers;

use App\Services\WilayahService;
use Illuminate\Http\Request;

class WilayahController extends Controller
{
    protected $svc;
    public function __construct(WilayahService $svc) { $this->svc = $svc; }

    public function provinces() { return response()->json($this->svc->provinces()); }
    public function regencies($code) { return response()->json($this->svc->regencies($code)); }
    public function districts($code) { return response()->json($this->svc->districts($code)); }
    public function villages($code) { return response()->json($this->svc->villages($code)); }
}