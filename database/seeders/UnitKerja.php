<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UnitKerja extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\UnitKerja::create([
            'unit_kerja' => 'Default Kategori',
        ]);

        \App\Models\UnitKerja::create([
            'unit_kerja' => 'Yayasan',
        ]);
        \App\Models\UnitKerja::create([
            'unit_kerja' => 'Pimpinan',
        ]);
        \App\Models\UnitKerja::create([
            'unit_kerja' => 'Dewan Pengawas',
        ]);
        \App\Models\UnitKerja::create([
            'unit_kerja' => 'SDM',
        ]);
        \App\Models\UnitKerja::create([
            'unit_kerja' => 'Logistik',
        ]);
        \App\Models\UnitKerja::create([
            'unit_kerja' => 'Keuangan',
        ]);
        \App\Models\UnitKerja::create([
            'unit_kerja' => 'IPSRS',
        ]);
        \App\Models\UnitKerja::create([
            'unit_kerja' => 'Driver',
        ]);
        \App\Models\UnitKerja::create([
            'unit_kerja' => 'Teratai',
        ]);
        \App\Models\UnitKerja::create([
            'unit_kerja' => 'ICU',
        ]);
        \App\Models\UnitKerja::create([
            'unit_kerja' => 'Tulip',
        ]);
        \App\Models\UnitKerja::create([
            'unit_kerja' => 'VK&Perinatalogi',
        ]);
        \App\Models\UnitKerja::create([
            'unit_kerja' => 'IBS&CSSD',
        ]);
        \App\Models\UnitKerja::create([
            'unit_kerja' => 'Dokter Umum',
        ]);
        \App\Models\UnitKerja::create([
            'unit_kerja' => 'IGD',
        ]);
        \App\Models\UnitKerja::create([
            'unit_kerja' => 'IRJT',
        ]);
        \App\Models\UnitKerja::create([
            'unit_kerja' => 'CASEMIX',
        ]);
        \App\Models\UnitKerja::create([
            'unit_kerja' => 'Refraksionis Optisi',
        ]);
        \App\Models\UnitKerja::create([
            'unit_kerja' => 'Radiologi',
        ]);
        \App\Models\UnitKerja::create([
            'unit_kerja' => 'Rekam Medis',
        ]);
        \App\Models\UnitKerja::create([
            'unit_kerja' => 'TPPRI&Front Office',
        ]);
        \App\Models\UnitKerja::create([
            'unit_kerja' => 'Farmasi',
        ]);
        \App\Models\UnitKerja::create([
            'unit_kerja' => 'Laboratorium',
        ]);
        \App\Models\UnitKerja::create([
            'unit_kerja' => 'Gizi&Dapur',
        ]);
        \App\Models\UnitKerja::create([
            'unit_kerja' => 'Kebersihan',
        ]);
        \App\Models\UnitKerja::create([
            'unit_kerja' => 'Laundry',
        ]);
        \App\Models\UnitKerja::create([
            'unit_kerja' => 'Cleaning Service',
        ]);
        \App\Models\UnitKerja::create([
            'unit_kerja' => 'Security',
        ]);
    }
}
