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
            'kode_barang' => 'Y'
        ]);
        \App\Models\UnitKerja::create([
            'unit_kerja' => 'Pimpinan',
            'kode_barang' => 'P'
        ]);
        \App\Models\UnitKerja::create([
            'unit_kerja' => 'Dewan Pengawas',
            'kode_barang' => 'DP'
        ]);
        \App\Models\UnitKerja::create([
            'unit_kerja' => 'SDM',
            'kode_barang' => 'SDM'
        ]);
        \App\Models\UnitKerja::create([
            'unit_kerja' => 'Logistik',
            'kode_barang' => 'L'
        ]);
        \App\Models\UnitKerja::create([
            'unit_kerja' => 'Keuangan',
            'kode_barang' => 'K'
        ]);
        \App\Models\UnitKerja::create([
            'unit_kerja' => 'IPSRS',
            'kode_barang' => 'IPRS'
        ]);
        \App\Models\UnitKerja::create([
            'unit_kerja' => 'Driver',
            'kode_barang' => 'D'
        ]);
        \App\Models\UnitKerja::create([
            'unit_kerja' => 'Teratai',
            'kode_barang' => 'TRT'
        ]);
        \App\Models\UnitKerja::create([
            'unit_kerja' => 'ICU',
            'kode_barang' => 'ICU'
        ]);
        \App\Models\UnitKerja::create([
            'unit_kerja' => 'Tulip',
            'kode_barang' => 'TLP'
        ]);
        \App\Models\UnitKerja::create([
            'unit_kerja' => 'VK&Perinatalogi',
            'kode_barang' => 'VK'
        ]);
        \App\Models\UnitKerja::create([
            'unit_kerja' => 'IBS&CSSD',
            'kode_barang' => 'IBS'
        ]);
        \App\Models\UnitKerja::create([
            'unit_kerja' => 'Dokter Umum',
            'kode_barang' => 'DU'
        ]);
        \App\Models\UnitKerja::create([
            'unit_kerja' => 'IGD',
            'kode_barang' => 'IGD'
        ]);
        \App\Models\UnitKerja::create([
            'unit_kerja' => 'IRJT',
            'kode_barang' => 'IRJT'
        ]);
        \App\Models\UnitKerja::create([
            'unit_kerja' => 'CASEMIX',
            'kode_barang' => 'CM'
        ]);
        \App\Models\UnitKerja::create([
            'unit_kerja' => 'Refraksionis Optisi',
            'kode_barang' => 'RO'
        ]);
        \App\Models\UnitKerja::create([
            'unit_kerja' => 'Radiologi',
            'kode_barang' => 'RAD'
        ]);
        \App\Models\UnitKerja::create([
            'unit_kerja' => 'Rekam Medis',
            'kode_barang' => 'RM'
        ]);
        \App\Models\UnitKerja::create([
            'unit_kerja' => 'TPPRI&Front Office',
            'kode_barang' => 'TPPRI'
        ]);
        \App\Models\UnitKerja::create([
            'unit_kerja' => 'Farmasi',
            'kode_barang' => 'F'
        ]);
        \App\Models\UnitKerja::create([
            'unit_kerja' => 'Laboratorium',
            'kode_barang' => 'LAB'
        ]);
        \App\Models\UnitKerja::create([
            'unit_kerja' => 'Gizi&Dapur',
            'kode_barang' => 'GD'
        ]);
        \App\Models\UnitKerja::create([
            'unit_kerja' => 'Kebersihan',
            'kode_barang' => 'KBR'
        ]);
        \App\Models\UnitKerja::create([
            'unit_kerja' => 'Laundry',
            'kode_barang' => 'LDR'
        ]);
        \App\Models\UnitKerja::create([
            'unit_kerja' => 'Cleaning Service',
            'kode_barang' => 'CS'
        ]);
        \App\Models\UnitKerja::create([
            'unit_kerja' => 'Security',
            'kode_barang' => 'S'
        ]);
    }
}
