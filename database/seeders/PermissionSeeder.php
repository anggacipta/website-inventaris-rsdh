<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
            'dashboard',
            'data.master',
            'read.barang',
            'create.barang',
            'update.barang',
            'delete.barang',
            'barang.dihapus',
            'maintenance',
            'maintenance.lanjut',
            'maintenance.rusak',
            'maintenance.diperbaiki',
            'users',
            'roles',
            'permission',
        ];

        foreach ($permissions as $permission) {
            \Spatie\Permission\Models\Permission::create(['name' => $permission]);
        }
    }
}
