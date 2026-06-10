<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;

class WilayahProxyController extends Controller
{
    public function provinces()
    {
        $response = Http::get('https://wilayah.id/api/provinces.json');
        return response($response->body(), $response->status())
            ->header('Content-Type', $response->header('Content-Type'));
    }

    public function regencies($province_code)
    {
        $url = "https://wilayah.id/api/regencies/{$province_code}.json";
        $response = Http::get($url);
        return response($response->body(), $response->status())
            ->header('Content-Type', $response->header('Content-Type'));
    }

    public function districts($regency_code)
    {
        $url = "https://wilayah.id/api/districts/{$regency_code}.json";
        $response = Http::get($url);
        return response($response->body(), $response->status())
            ->header('Content-Type', $response->header('Content-Type'));
    }

    public function villages($district_code)
    {
        $url = "https://wilayah.id/api/villages/{$district_code}.json";
        $response = Http::get($url);
        return response($response->body(), $response->status())
            ->header('Content-Type', $response->header('Content-Type'));
    }
}