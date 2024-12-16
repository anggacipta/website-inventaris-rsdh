<?php

use Illuminate\Support\Facades\Route;

// Route for server
Route::middleware(['auth'])->group(function () {

    Route::group(['middleware' => ['permission:dashboard']], function () {
        Route::get('dashboard', [\App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('dashboard.index');
    });

    Route::group(['middleware' => ['permission:data.master']], function () {
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

        // Route Distributor
        Route::resource('distributor', \App\Http\Controllers\Admin\DistributorController::class);

        // Route Vendor
        Route::resource('vendor', \App\Http\Controllers\Admin\VendorController::class);
    });

    // Route Barang
    Route::group(['middleware' => ['permission:create.barang']], function () {
        Route::get('barang/create', [\App\Http\Controllers\Admin\BarangController::class, 'create'])->name('barang.create');
        Route::post('barang', [\App\Http\Controllers\Admin\BarangController::class, 'store'])->name('barang.store');
    });
    Route::group(['middleware' => ['permission:read.barang']], function () {
        // Print for Label Barang
        Route::get('/print-sticker-all', [\App\Http\Controllers\Admin\BarangController::class, 'printStickerAll'])->name('print.sticker.all');
        Route::get('/print-sticker/{id}', [\App\Http\Controllers\Admin\BarangController::class, 'printSticker'])->name('print.sticker');
        // Read Barang
        Route::get('barang', [\App\Http\Controllers\Admin\BarangController::class, 'index'])->name('barang.index');
        // Print for Barang Report
        Route::get('barang/pdf', [\App\Http\Controllers\Admin\ExportLaporanController::class, 'export'])->name('barang.pdf');
    });
    Route::group(['middleware' => ['permission:update.barang']], function () {
        Route::get('barang/{id}/edit', [\App\Http\Controllers\Admin\BarangController::class, 'edit'])->name('barang.edit');
        Route::put('barang/{id}', [\App\Http\Controllers\Admin\BarangController::class, 'update'])->name('barang.update');
        Route::get('/kalibrasi-barang', [\App\Http\Controllers\Admin\KalibrasiBarangController::class, 'index'])->name('kalibrasi.barang.index');
        Route::get('/kalibrasi-barang/{id}', [\App\Http\Controllers\Admin\KalibrasiBarangController::class, 'editKalibrasi'])->name('kalibrasi.barang.edit');
        Route::put('/kalibrasi-barang/{id}', [\App\Http\Controllers\Admin\KalibrasiBarangController::class, 'updateKalibrasi'])->name('kalibrasi.barang.update');
    });
    Route::group(['middleware' => ['permission:delete.barang']], function () {
//        Route::delete('barang/{id}', [\App\Http\Controllers\Admin\BarangController::class, 'destroy'])->name('barang.destroy');
        Route::get('/hapus/log-barang/{id}', [\App\Http\Controllers\Admin\Logs\LogBarangHapusController::class, 'create'])->name('create.log.barang');
        Route::post('/hapus/log-barang/{id}', [\App\Http\Controllers\Admin\Logs\LogBarangHapusController::class, 'store'])->name('hapus.barang');
    });
    Route::group(['middleware' => ['permission:barang.dihapus']], function () {
        // Route Barang Dihapus Report
        Route::get('barang-dihapus/pdf', [\App\Http\Controllers\Admin\ExportLaporanController::class, 'exportOnlyTrashed'])->name('barang.dihapus.pdf');
        Route::get('barang/trash', [\App\Http\Controllers\Admin\BarangController::class, 'trash'])->name('barang.trash');
        Route::patch('/barang/restore/{id}', [\App\Http\Controllers\Admin\BarangController::class, 'restore'])->name('barang.restore');
        Route::delete('/barang/forceDelete/{id}', [\App\Http\Controllers\Admin\BarangController::class, 'destroyPermanent'])->name('barang.forceDelete');
    });

    // Route Maintenance
    Route::group(['middleware' => ['permission:maintenance']], function () {
        Route::get('maintenance', [\App\Http\Controllers\Admin\MaintenanceController::class, 'index'])->name('maintenance.index');
        Route::get('maintenance/create', [\App\Http\Controllers\Admin\MaintenanceController::class, 'create'])->name('maintenance.create');
        Route::get('maintenance/create/{id}', [\App\Http\Controllers\Admin\MaintenanceController::class, 'create'])->name('maintenance.create');
        Route::post('maintenance', [\App\Http\Controllers\Admin\MaintenanceController::class, 'store'])->name('maintenance.store');
    });
    Route::group(['middleware' => ['permission:maintenance.lanjut']], function () {
        Route::get('maintenance-lanjutan', [\App\Http\Controllers\Admin\MaintenanceController::class, 'indexMaintenanceLanjutan'])->name('maintenance.lanjutan.index');
        Route::get('maintenance-lanjutan/{maintenanceId}', [\App\Http\Controllers\Admin\MaintenanceController::class, 'createMaintenanceLanjutan'])->name('maintenance.lanjutan');
        Route::put('maintenance-lanjutan/{id}', [\App\Http\Controllers\Admin\MaintenanceController::class, 'updateMaintenanceLanjutan'])->name('maintenance.lanjutan.update');
        Route::get('maintenance-diperbaiki-lanjutan/{maintenanceId}', [\App\Http\Controllers\Admin\MaintenanceController::class, 'createBerhasilDiperbaikiLanjutan'])->name('maintenance.diperbaiki.lanjutan');
    });
    Route::group(['middleware' => ['permission:maintenance.rusak']], function () {
        Route::get('maintenance-rusak', [\App\Http\Controllers\Admin\MaintenanceController::class, 'indexMaintenanceRusak'])->name('maintenance.rusak.index');
        Route::get('maintenance-rusak/{maintenanceId}', [\App\Http\Controllers\Admin\MaintenanceController::class, 'createMaintenanceRusak'])->name('maintenance.rusak');
        Route::put('maintenance-rusak/{id}', [\App\Http\Controllers\Admin\MaintenanceController::class, 'updateMaintenanceRusak'])->name('maintenance.rusak.update');
        Route::get('barang-pergantian', [\App\Http\Controllers\Admin\PenggantianBarangController::class, 'index'])->name('penggantian.barang.index');
        Route::get('barang-pergantian/{id}', [\App\Http\Controllers\Admin\PenggantianBarangController::class, 'edit'])->name('penggantian.barang.edit');
        Route::put('barang-pergantian/{id}', [\App\Http\Controllers\Admin\PenggantianBarangController::class, 'update'])->name('penggantian.barang.update');
    });
    Route::group(['middleware' => ['permission:maintenance.diperbaiki']], function () {
        Route::get('maintenance-diperbaiki', [\App\Http\Controllers\Admin\MaintenanceController::class, 'indexMaintenanceDiperbaiki'])->name('maintenance.diperbaiki.index');
        Route::get('maintenance-diperbaiki/{maintenanceId}', [\App\Http\Controllers\Admin\MaintenanceController::class, 'createBerhasilDiperbaiki'])->name('maintenance.diperbaiki');
        Route::put('maintenance-diperbaiki/{id}', [\App\Http\Controllers\Admin\MaintenanceController::class, 'updateMaintenanceDiperbaiki'])->name('maintenance.diperbaiki.update');
    });

    // Route Users
    Route::group(['middleware' => ['permission:users']], function () {
        Route::get('users', [\App\Http\Controllers\UserController::class, 'index'])->name('users.index');
        Route::get('users/create', [\App\Http\Controllers\UserController::class, 'create'])->name('users.create');
        Route::post('users', [\App\Http\Controllers\UserController::class, 'store'])->name('users.store');
        Route::get('users/{user}/edit', [\App\Http\Controllers\UserController::class, 'edit'])->name('users.edit');
        Route::get('users/{id}', [\App\Http\Controllers\UserController::class, 'show'])->name('users.show');
        Route::put('users/{user}', [\App\Http\Controllers\UserController::class, 'update'])->name('users.update');
        Route::delete('users/{user}', [\App\Http\Controllers\UserController::class, 'destroy'])->name('users.destroy');
    });

    // Route Roles and Permissions
    Route::group(['middleware' => ['permission:roles|permission']], function () {
        // Route Roles
        Route::resource('roles', \App\Http\Controllers\RolePermissionController::class);

        // Route Permissions
        Route::resource('permissions', \App\Http\Controllers\PermissionController::class);

        // Extra Route Roles and Permissions
        Route::get('/role-assignment', [\App\Http\Controllers\RolePermissionController::class, 'showForm'])->name('role-assignment.form');
        Route::post('/role-assignment', [\App\Http\Controllers\RolePermissionController::class, 'assignRole'])->name('role-assignment.assign');
        Route::get('roles/{role}/permissions', [\App\Http\Controllers\RolePermissionController::class, 'edit'])->name('roles.permissions.edit');
        Route::put('roles/{role}/permissions', [\App\Http\Controllers\RolePermissionController::class, 'update'])->name('roles.permissions.update');
    });

    // Route Persetujuan Staff Ahli
    Route::group(['middleware' => ['permission:staff.ahli.persetujuan']], function () {
        Route::get('/setuju/staff/{id}', [\App\Http\Controllers\Admin\PersetujuanController::class, 'createPersetujuanStaff'])->name('setuju.staff');
        Route::get('/tidak-setuju/staff/{id}', [\App\Http\Controllers\Admin\PersetujuanController::class, 'createPertidaksetujuanStaff'])->name('tidak.setuju.staff');
        Route::post('/setuju/staff/{id}', [\App\Http\Controllers\Admin\PersetujuanController::class, 'storePersetujuanStaff'])->name('store.setuju.staff');
        Route::post('/tidak-setuju/staff/{id}', [\App\Http\Controllers\Admin\PersetujuanController::class, 'storePertidaksetujuanStaff'])->name('store.tidak.setuju.staff');
    });

    // Route Persetujuan Direktur
    Route::group(['middleware' => ['permission:direktur.persetujuan']], function () {
        Route::get('/setuju/direktur/{id}', [\App\Http\Controllers\Admin\PersetujuanController::class, 'createPersetujuanDirektur'])->name('setuju.direktur');
        Route::get('/tidak-setuju/direktur/{id}', [\App\Http\Controllers\Admin\PersetujuanController::class, 'createPertidaksetujuanDirektur'])->name('tidak.setuju.direktur');
        Route::post('/setuju/direktur/{id}', [\App\Http\Controllers\Admin\PersetujuanController::class, 'storePersetujuanDirektur'])->name('store.setuju.direktur');
        Route::post('/tidak-setuju/direktur/{id}', [\App\Http\Controllers\Admin\PersetujuanController::class, 'storePertidaksetujuanDirektur'])->name('store.tidak.setuju.direktur');
    });

    // Route Log
    Route::group(['middleware' => ['permission:log.maintenance']], function () {
        Route::get('/log-maintenance', [\App\Http\Controllers\Admin\Logs\LogMaintenanceController::class, 'index'])->name('log.maintenance');
        Route::get('/log-maintenance/export-pdf', [\App\Http\Controllers\Admin\ExportLaporanController::class, 'exportLogMaintenance'])->name('log.maintenance.pdf');
    });
    Route::group(['middleware' => ['permission:log.persetujuan.maintenance']], function () {
        Route::get('/log-persetujuan-maintenance', [\App\Http\Controllers\Admin\Logs\LogPersetujuanMaintenanceController::class, 'index'])->name('log.persetujuan.maintenance');
        Route::get('/log-persetujuan-maintenance/{id}', [\App\Http\Controllers\Admin\Logs\LogPersetujuanMaintenanceController::class, 'show'])->name('log.persetujuan.maintenance.show');
        Route::get('/log-persetujuans-maintenance/export-pdf', [\App\Http\Controllers\Admin\ExportLaporanController::class, 'exportLogPersetujuanMaintenance'])->name('log.persetujuan.maintenance.pdf');
    });
    Route::group(['middleware' => ['permission:log.barang.dihapus']], function () {
        Route::get('/log-barang', [\App\Http\Controllers\Admin\Logs\LogBarangHapusController::class, 'index'])->name('log.barang');
        Route::get('/log-barang-tambah', [\App\Http\Controllers\Admin\Logs\LogBarangTambahController::class, 'index'])->name('log.barang.tambah');
        Route::get('/log-kalibrasi-barang', [\App\Http\Controllers\Admin\Logs\LogKalibrasiBarangController::class, 'index'])->name('log.kalibrasi.barang');
        Route::get('/log-barang-tambah/pdf', [\App\Http\Controllers\Admin\ExportLaporanController::class, 'exportLogBarangTambah'])->name('log.barang.tambah.pdf');
        Route::get('/log-barang-dihapus/export-pdf', [\App\Http\Controllers\Admin\ExportLaporanController::class, 'exportLogBarangDihapus'])->name('log.barang.dihapus.pdf');
        Route::get('/log-kalibrasi-barang/export-pdf', [\App\Http\Controllers\Admin\ExportLaporanController::class, 'exportLogKalibrasiBarang'])->name('log.kalibrasi.barang.pdf');
    });

    // Get Kode Barang
    Route::get('barang/count/{unitKerjaId}', [\App\Http\Controllers\Admin\BarangController::class, 'countByUnitKerja']);
    Route::get('barang/kode-barang/{unitKerjaId}/{jenisBarangId}/{tahunPengadaan}/{id?}', [\App\Http\Controllers\Admin\BarangController::class, 'getKodeBarang']);
});
