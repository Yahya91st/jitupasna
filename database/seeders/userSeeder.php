<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\FormulirItem;
use App\Models\Formulir;
use App\Models\Kajian;
use App\Models\LaporanBencana;
use App\Models\Bencana;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Formulir::truncate();
        FormulirItem::truncate();
        Kajian::truncate();
        LaporanBencana::truncate();
        Bencana::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');





        User::create([
            'name' => 'Admin',
            'email' => 'admin@jitupasna.com',
            'password' => Hash::make('password'),
            'role' => 'operator',
        ]);

        User::create([
            'name' => 'Pelapor Demo',
            'email' => 'pelapor@jitupasna.com',
            'password' => Hash::make('password'),
            'role' => 'pelapor',
        ]);

        User::create([
            'name' => 'Pengkaji Demo',
            'email' => 'pengkaji@jitupasna.com',
            'password' => Hash::make('password'),
            'role' => 'pengkaji',
        ]);

        User::create([
            'name' => 'Pimpinan Demo',
            'email' => 'pimpinan@jitupasna.com',
            'password' => Hash::make('password'),
            'role' => 'pimpinan',
        ]);
    }
}