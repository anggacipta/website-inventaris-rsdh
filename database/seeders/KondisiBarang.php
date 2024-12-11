<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KondisiBarang extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\KondisiBarang::create([
            'kondisi_barang' => 'Default Kategori',
        ]);

        \App\Models\KondisiBarang::create([
            'kondisi_barang' => 'Normal',
        ]);

        \App\Models\KondisiBarang::create([
            'kondisi_barang' => 'Rusak',
        ]);

        \App\Models\KondisiBarang::create([
            'kondisi_barang' => 'Maintenance',
        ]);

        \App\Models\KondisiBarang::create([
            'kondisi_barang' => 'Maintenance Lanjutan',
        ]);

        \App\Models\KondisiBarang::create([
            'kondisi_barang' => 'Berhasil Diperbaiki',
        ]);

        \App\Models\KondisiBarang::create([
            'kondisi_barang' => 'Digantikan',
        ]);
    }
}
