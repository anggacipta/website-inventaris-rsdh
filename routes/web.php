<?php

use Illuminate\Support\Facades\Route;

// Route for server
Route::middleware(['auth'])->group(function () {
    Route::get('dashboard', [\App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('dashboard.index');

    // Route Barang
    Route::resource('barang', \App\Http\Controllers\Admin\BarangController::class);

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
    // Print for Barang
    Route::get('/print-sticker-all', [\App\Http\Controllers\Admin\BarangController::class, 'printStickerAll'])->name('print.sticker.all');
    Route::get('/print-sticker/{id}', [\App\Http\Controllers\Admin\BarangController::class, 'printSticker'])->name('print.sticker');

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
