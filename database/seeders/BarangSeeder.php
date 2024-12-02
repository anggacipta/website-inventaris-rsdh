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
        for ($i = 0; $i <= 1000; $i++) {
            \App\Models\Barang::create([
                'nama_barang' => 'Mikroscope' . $i,
                'merk_barang_id' => 1,
                'harga' => 0,
                'kondisi_barang_id' => 1,
                'jenis_barang_id' => 1,
                'sumber_pengadaan_id' => 1,
                'unit_kerja_id' => 1,
                'photo' => '1728974782.jpg',
                'kode_barang' => '1234567890' . $i,
                'tahun_pengadaan' => '2024-01-01',
                'tahun' => '2024',
            ]);
        }
    }
}
