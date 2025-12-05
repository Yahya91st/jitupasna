<?php
namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;

class WilayahService
{
    protected $base = 'https://wilayah.id/api';

    protected function fetch(string $path)
    {
        $cacheKey = 'wilayah:' . md5($path);
        return Cache::remember($cacheKey, 3600, function () use ($path) {
            $res = Http::timeout(10)->retry(2, 100)->get("{$this->base}/{$path}");
            if ($res->successful()) {
                return $res->json();
            }
            return [];
        });
    }

    public function provinces() { return $this->fetch('provinces.json'); }
    public function regencies($provinceCode) { return $this->fetch("regencies/{$provinceCode}.json"); }
    public function districts($regencyCode) { return $this->fetch("districts/{$regencyCode}.json"); }
    public function villages($districtCode) { return $this->fetch("villages/{$districtCode}.json"); }
}