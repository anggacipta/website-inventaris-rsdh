<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MerkBarang extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\MerkBarang::create([
            'merk_barang' => 'Default Kategori',
        ]);

        \App\Models\MerkBarang::create([
            'merk_barang' => 'Asus',
        ]);
    }
}
