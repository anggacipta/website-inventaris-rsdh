<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class JenisBarang extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\JenisBarang::create([
            'jenis_barang' => 'Default Kategori',
        ]);

        \App\Models\JenisBarang::create([
            'jenis_barang' => 'Elektronik',
            'kode_barang' => 'E'
        ]);

        \App\Models\JenisBarang::create([
            'jenis_barang' => 'Komputer',
            'kode_barang' => 'K'
        ]);

        \App\Models\JenisBarang::create([
            'jenis_barang' => 'Alat Rumah Tangga',
            'kode_barang' => 'ART'
        ]);

        \App\Models\JenisBarang::create([
            'jenis_barang' => 'Alat Kesehatan',
            'kode_barang' => 'AK'
        ]);
    }
}
