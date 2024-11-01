<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BarangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Barang::create([
            'nama_barang' => 'Mikroscope',
            'merk_barang_id' => 1,
            'vendor_id' => 1,
            'harga' => 0,
            'stok' => 0,
            'kondisi_barang_id' => 1,
        ]);
    }
}
