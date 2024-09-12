<?php

namespace Database\Seeders;

use App\Models\Vendor;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class VendorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Vendor::create([
            'nama_vendor' => 'Default Kategori',
        ]);

        Vendor::create([
            'nama_vendor' => 'PT. Merdeka Kita'
        ]);
    }
}
