<?php
namespace App\Http\Controllers;

use App\Services\WilayahService;
use Illuminate\Http\Request;

class WilayahController extends Controller
{
    protected $svc;
    public function __construct(WilayahService $svc) { $this->svc = $svc; }

    public function provinces()
    {
        return Cache::remember('provinces', 86400, function () {
            return Http::get('https://wilayah.id/api/provinces')->json();
        });
    }    
    
    public function regencies($code)
    {
        return Cache::remember("regencies_$code", 86400, function () use ($code) {
            return Http::get("https://wilayah.id/api/regencies/$code")->json();
        });
    }    
    
    public function districts($code)
    {
        return Cache::remember("districts_$code", 86400, function () use ($code) {
            return Http::get("https://wilayah.id/api/districts/$code")->json();
        });
    }    
    
    public function villages($code)
    {
        return Cache::remember("villages_$code", 86400, function () use ($code) {
            return Http::get("https://wilayah.id/api/villages/$code")->json();
        });
    }
}