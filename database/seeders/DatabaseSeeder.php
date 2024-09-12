<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // Create roles
        Role::create(['name' => 'user']);
        Role::create(['name' => 'iprs']);
        Role::create(['name' => 'server']);

        $this->call([
            KondisiBarang::class,
            UnitKerja::class,
            JenisBarang::class,
            MerkBarang::class,
            SumberPengadaan::class,
            VendorSeeder::class,
            PermissionSeeder::class,
            RolePermissionSeeder::class
        ]);

        // Retrieve roles
        $serverRole = Role::where('name', 'server')->first();
        $iprsRole = Role::where('name', 'iprs')->first();
        $userRole = Role::where('name', 'user')->first();

        // Retrieve unit_kerja records
        $serverUnitKerja = \App\Models\UnitKerja::where('unit_kerja', 'Logistik')->first();
        $iprsUnitKerja = \App\Models\UnitKerja::where('unit_kerja', 'IPSRS')->first();
        $driverUnitKerja = \App\Models\UnitKerja::where('unit_kerja', 'Driver')->first();

        // Create users and assign roles
        $adminUser = User::create([
            'name' => 'IPSRS',
            'username' => 'admin',
            'password' => bcrypt('admin'),
            'email' => 'admin@gmail.com',
            'unit_kerja_id' => $iprsUnitKerja->id,
            'role_id' => $iprsRole->id,
        ]);
        $adminUser->assignRole($iprsRole->name);

        $serverUser = User::create([
            'name' => 'Server',
            'username' => 'server',
            'password' => bcrypt('server'),
            'email' => 'server@gmail.com',
            'unit_kerja_id' => $serverUnitKerja->id,
            'role_id' => $serverRole->id,
        ]);
        $serverUser->assignRole($serverRole->name);

        $userUser = User::create([
            'name' => 'User',
            'username' => 'user',
            'password' => bcrypt('user'),
            'email' => 'coba@gmail.com',
            'unit_kerja_id' => $driverUnitKerja->id,
            'role_id' => $userRole->id,
        ]);
        $userUser->assignRole($userRole->name);
    }
}
