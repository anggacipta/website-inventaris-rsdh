<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SumberPengadaan extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\SumberPengadaan::create([
            'sumber_pengadaan' => 'Default Kategori',
        ]);

        \App\Models\SumberPengadaan::create([
            'sumber_pengadaan' => 'RSDH',
        ]);

        \App\Models\SumberPengadaan::create([
            'sumber_pengadaan' => 'KSO/PINJAMAN',
        ]);

        \App\Models\SumberPengadaan::create([
            'sumber_pengadaan' => 'Hibah/PEMBERIAN',
        ]);

        \App\Models\SumberPengadaan::create([
            'sumber_pengadaan' => 'SWADANA',
        ]);
    }
}
