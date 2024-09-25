<?php

use Illuminate\Support\Facades\Route;

// Route for server
Route::middleware(['auth'])->group(function () {
    Route::get('dashboard', [\App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('dashboard.index');

    // Route Barang
    Route::get('barang/trash', [\App\Http\Controllers\Admin\BarangController::class, 'trash'])->name('barang.trash');
    Route::patch('/barang/restore/{id}', [\App\Http\Controllers\Admin\BarangController::class, 'restore'])->name('barang.restore');
    Route::delete('/barang/forceDelete/{id}', [\App\Http\Controllers\Admin\BarangController::class, 'destroyPermanent'])->name('barang.forceDelete');
    Route::resource('barang', \App\Http\Controllers\Admin\BarangController::class);

    // Route Persetujuan Maintenance Lanjutan
    Route::get('/setuju/staff/{id}', [\App\Http\Controllers\Admin\PersetujuanController::class, 'createPersetujuanStaff'])->name('setuju.staff');
    Route::get('/tidak-setuju/staff/{id}', [\App\Http\Controllers\Admin\PersetujuanController::class, 'createPertidaksetujuanStaff'])->name('tidak.setuju.staff');
    Route::get('/setuju/direktur/{id}', [\App\Http\Controllers\Admin\PersetujuanController::class, 'createPersetujuanDirektur'])->name('setuju.direktur');
    Route::get('/tidak-setuju/direktur/{id}', [\App\Http\Controllers\Admin\PersetujuanController::class, 'createPertidaksetujuanDirektur'])->name('tidak.setuju.direktur');
    Route::post('/setuju/staff/{id}', [\App\Http\Controllers\Admin\PersetujuanController::class, 'storePersetujuanStaff'])->name('store.setuju.staff');
    Route::post('/setuju/direktur/{id}', [\App\Http\Controllers\Admin\PersetujuanController::class, 'storePersetujuanDirektur'])->name('store.setuju.direktur');
    Route::post('/tidak-setuju/staff/{id}', [\App\Http\Controllers\Admin\PersetujuanController::class, 'storePertidaksetujuanStaff'])->name('store.tidak.setuju.staff');
    Route::post('/tidak-setuju/direktur/{id}', [\App\Http\Controllers\Admin\PersetujuanController::class, 'storePertidaksetujuanDirektur'])->name('store.tidak.setuju.direktur');

    // Route Log Barang
    Route::get('/log-barang', [\App\Http\Controllers\Admin\LogBarangController::class, 'index'])->name('log.barang');
    Route::get('/hapus/log-barang/{id}', [\App\Http\Controllers\Admin\LogBarangController::class, 'create'])->name('create.log.barang');
    Route::post('/hapus/log-barang/{id}', [\App\Http\Controllers\Admin\LogBarangController::class, 'store'])->name('hapus.barang');

    // Route Jenis Barang
    Route::resource('jenis-barang', \App\Http\Controllers\Admin\JenisBarangController::class);

    // Route Merk Barang
    Route::resource('merk-barang', \App\Http\Controllers\Admin\MerkBarangController::class);

    // Route Kondisi Barang
    Route::resource('kondisi-barang', \App\Http\Controllers\Admin\KondisiBarangController::class);

    // Route Sumber Pengadaan
    Route::resource('sumber-pengadaan', \App\Http\Controllers\Admin\SumberPengadaanController::class);

    // Route Unit Kerja
    Route::resource('unit-kerja', \App\Http\Controllers\Admin\UnitKerjaController::class);

    // Route Vendor
    Route::resource('vendor', \App\Http\Controllers\Admin\VendorController::class);

    // Route Maintenance
    Route::resource('maintenance', \App\Http\Controllers\Admin\MaintenanceController::class);

    // Extra Route Maintenance
    Route::get('maintenance-lanjutan', [\App\Http\Controllers\Admin\MaintenanceController::class, 'indexMaintenanceLanjutan'])->name('maintenance.lanjutan.index');
    Route::get('maintenance-rusak', [\App\Http\Controllers\Admin\MaintenanceController::class, 'indexMaintenanceRusak'])->name('maintenance.rusak.index');
    Route::get('maintenance-diperbaiki', [\App\Http\Controllers\Admin\MaintenanceController::class, 'indexMaintenanceDiperbaiki'])->name('maintenance.diperbaiki.index');
    Route::get('maintenance/create/{id}', [\App\Http\Controllers\Admin\MaintenanceController::class, 'create'])->name('maintenance.create');
    Route::get('maintenance-lanjutan/{maintenanceId}', [\App\Http\Controllers\Admin\MaintenanceController::class, 'createMaintenanceLanjutan'])->name('maintenance.lanjutan');
    Route::put('maintenance-lanjutan/{id}', [\App\Http\Controllers\Admin\MaintenanceController::class, 'updateMaintenanceLanjutan'])->name('maintenance.lanjutan.update');
    Route::get('maintenance-rusak/{maintenanceId}', [\App\Http\Controllers\Admin\MaintenanceController::class, 'createMaintenanceRusak'])->name('maintenance.rusak');
    Route::put('maintenance-rusak/{id}', [\App\Http\Controllers\Admin\MaintenanceController::class, 'updateMaintenanceRusak'])->name('maintenance.rusak.update');
    Route::get('maintenance-diperbaiki/{maintenanceId}', [\App\Http\Controllers\Admin\MaintenanceController::class, 'createBerhasilDiperbaiki'])->name('maintenance.diperbaiki');
    Route::get('maintenance-diperbaiki-lanjutan/{maintenanceId}', [\App\Http\Controllers\Admin\MaintenanceController::class, 'createBerhasilDiperbaikiLanjutan'])->name('maintenance.diperbaiki.lanjutan');
    Route::put('maintenance-diperbaiki/{id}', [\App\Http\Controllers\Admin\MaintenanceController::class, 'updateMaintenanceDiperbaiki'])->name('maintenance.diperbaiki.update');

    // Get Kode Barang
    Route::get('barang/count/{unitKerjaId}', [\App\Http\Controllers\Admin\BarangController::class, 'countByUnitKerja']);
    Route::get('barang/kode-barang/{unitKerjaId}/{jenisBarangId}/{tahunPengadaan}/{id?}', [\App\Http\Controllers\Admin\BarangController::class, 'getKodeBarang']);

    // Print for Barang
    Route::get('/print-sticker-all', [\App\Http\Controllers\Admin\BarangController::class, 'printStickerAll'])->name('print.sticker.all');
    Route::get('/print-sticker/{id}', [\App\Http\Controllers\Admin\BarangController::class, 'printSticker'])->name('print.sticker');

    // Route Log Maintenance
    Route::get('/log-maintenance', [\App\Http\Controllers\Admin\LogMaintenanceController::class, 'index'])->name('log.maintenance');

    // Route Log Persetujuan Maintenance
    Route::get('/log-persetujuan-maintenance', [\App\Http\Controllers\Admin\LogPersetujuanMaintenanceController::class, 'index'])->name('log.persetujuan.maintenance');
    Route::get('/log-persetujuan-maintenance/{id}', [\App\Http\Controllers\Admin\LogPersetujuanMaintenanceController::class, 'show'])->name('log.persetujuan.maintenance.show');

    // Route Roles
    Route::resource('roles', \App\Http\Controllers\RolePermissionController::class);

    // Route Permissions
    Route::resource('permissions', \App\Http\Controllers\PermissionController::class);

    // Extra Route Roles and Permissions
    Route::get('/role-assignment', [\App\Http\Controllers\RolePermissionController::class, 'showForm'])->name('role-assignment.form');
    Route::post('/role-assignment', [\App\Http\Controllers\RolePermissionController::class, 'assignRole'])->name('role-assignment.assign');
    Route::get('roles/{role}/permissions', [\App\Http\Controllers\RolePermissionController::class, 'edit'])->name('roles.permissions.edit');
    Route::put('roles/{role}/permissions', [\App\Http\Controllers\RolePermissionController::class, 'update'])->name('roles.permissions.update');

    // Route Users
    Route::get('users', [\App\Http\Controllers\UserController::class, 'index'])->name('users.index');
    Route::get('users/create', [\App\Http\Controllers\UserController::class, 'create'])->name('users.create');
    Route::post('users', [\App\Http\Controllers\UserController::class, 'store'])->name('users.store');
    Route::get('users/{user}/edit', [\App\Http\Controllers\UserController::class, 'edit'])->name('users.edit');
    Route::get('users/{id}', [\App\Http\Controllers\UserController::class, 'show'])->name('users.show');
    Route::put('users/{user}', [\App\Http\Controllers\UserController::class, 'update'])->name('users.update');
    Route::delete('users/{user}', [\App\Http\Controllers\UserController::class, 'destroy'])->name('users.destroy');
});
