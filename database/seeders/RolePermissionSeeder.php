<?php

namespace Database\Seeders;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $rolesPermissions = [
            'user' => ['read.barang', 'maintenance'],
            'iprs' => ['data.master', 'read.barang', 'create.barang', 'update.barang', 'delete.barang', 'maintenance', 'maintenance.lanjut', 'maintenance.rusak', 'maintenance.diperbaiki'],
            'server' => ['dashboard', 'data.master', 'read.barang', 'create.barang', 'update.barang', 'delete.barang', 'maintenance', 'maintenance.lanjut', 'maintenance.rusak',
                'maintenance.diperbaiki', 'users', 'roles', 'permission', 'barang.dihapus', 'log.maintenance', 'log.persetujuan.maintenance', 'log.barang.dihapus'],
            'staff_ahli' => ['read.barang', 'staff.ahli.persetujuan', 'maintenance.lanjut', 'log.maintenance', 'log.persetujuan.maintenance'],
            'direktur' => ['dashboard', 'read.barang', 'direktur.persetujuan', 'maintenance.lanjut', 'log.maintenance', 'log.persetujuan.maintenance'],
        ];

        foreach ($rolesPermissions as $role => $permissions) {
            $role = Role::where('name', $role)->first();
            foreach ($permissions as $permissionName) {
                $permission = Permission::where('name', $permissionName)->first();
                $role->givePermissionTo($permission);
            }
        }
    }
}
