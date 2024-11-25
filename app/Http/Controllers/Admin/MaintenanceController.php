<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Barang;
use App\Models\KondisiBarang;
use App\Models\Maintenance;
use App\Models\Role;
use App\Models\UnitKerja;
use App\Models\User;
use App\Models\Vendor;
use App\Service\FonnteService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class MaintenanceController extends Controller
{
    protected $fonnteService;

    public function __construct(FonnteService $fonnteService)
    {
        $this->fonnteService = $fonnteService;
    }

    public function index()
    {
        $user = auth()->user();
        $maintenanceConditionId = KondisiBarang::where('kondisi_barang', 'Maintenance')->first()->id;

        $maintenances = Maintenance::query()
            ->when($user->role->name !== 'server', function ($query) use ($user) {
                $query->when($user->role->name === 'iprs', function ($query) {
                    $query->whereHas('barang.jenisBarang', function ($query) {
                        $query->whereIn('jenis_barang', ['Elektronik', 'Alat Kesehatan', 'Alat Rumah Tangga']);
                    });
                })
                    ->when($user->role->name, function ($query) {
                        $query->whereHas('barang.unitKerja', function ($query) {
                            $query->where('unit_kerja_id', auth()->user()->unit_kerja_id);
                        });
                    });
            })
            ->where('kondisi_barang_id', $maintenanceConditionId)
            ->with('barang')
            ->orderBy('updated_at')
            ->get();

        return view('dashboard.admin.maintenance.index', compact('maintenances'));
    }

    public function indexMaintenanceLanjutan()
    {
        $maintenances = Maintenance::query()
            ->whereHas('kondisiBarang', function ($query) {
                $query->where('kondisi_barang', 'like', 'Maintenance Lanjutan')
                    ->orWhere('kondisi_barang', 'like', 'maintenance lanjutan');
            })
            ->with('barang')
            ->get();
        return view('dashboard.admin.maintenance.index_maintenance_lanjutan', compact('maintenances'));
    }

    public function indexMaintenanceDiperbaiki()
    {
        $maintenances = Maintenance::query()
            ->whereHas('kondisiBarang', function ($query) {
                $query->where('kondisi_barang', 'like', 'Berhasil Diperbaiki')
                    ->orWhere('kondisi_barang', 'like', 'berhasil diperbaiki');
            })
            ->with('barang')
            ->get();
        return view('dashboard.admin.maintenance.index_maintenance_diperbaiki', compact('maintenances'));
    }

    public function indexMaintenanceRusak()
    {
        $maintenances = Maintenance::query()
            ->whereHas('kondisiBarang', function ($query) {
                $query->where('kondisi_barang', 'like', 'Rusak')
                    ->orWhere('kondisi_barang', 'like', 'rusak');
            })
            ->with('barang')
            ->get();
        return view('dashboard.admin.maintenance.index_maintenance_rusak', compact('maintenances'));
    }

    public function create($barangId)
    {
        try {
            $kondisiBarang = KondisiBarang::where('kondisi_barang', 'like', 'Maintenance')
                ->orWhere('kondisi_barang', 'like', 'maintenance')
                ->firstOrFail();

            $id = $kondisiBarang->id;

            $barang = Barang::find($barangId);
            return view('dashboard.admin.maintenance.create', compact('barang', 'kondisiBarang'));
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            // kondisi_barang 'Maintenance' atau 'maintenance' tidak ditemukan
            // Anda bisa mengarahkan user ke halaman error atau memberikan pesan error
        }
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'alasan_rusak' => 'required',
                'kondisi_barang_id' => 'required',
                'barang_id' => 'required',
            ]);

            $maintenanceData = $request->all();
            Maintenance::create($maintenanceData);

            $barang = Barang::find($request->barang_id);
            $barang->update([
                'kondisi_barang_id' => KondisiBarang::where('kondisi_barang', 'Maintenance')->first()->id
            ]);

            // Send message to all users with role iprs and server
//            $roles = Role::whereIn('name', ['iprs', 'server'])->pluck('id');
//            $users = User::whereIn('role_id', $roles)->get();
//            $unitKerja = UnitKerja::find($barang->unit_kerja_id);
//            $message = "Maintenance barang diperlukan" . "\n" .
//                "Barang: " . $barang->nama_barang . "\n" .
//                "Unit Kerja: " . $unitKerja->unit_kerja . "\n" .
//                "Alasan Rusak: " . $request->alasan_rusak;
//
//            foreach ($users as $user) {
//                $this->fonnteService->sendMessage($user->phone, $message);
//            }

            return redirect()->route('maintenance.index')->with('success', 'Data maintenance berhasil ditambahkan');
        } catch (\Exception $e) {
            Log::error('Error in MaintenanceController@store: ', ['error' => $e->getMessage()]);
            return back()->with('error', 'Terjadi kesalahan saat menambahkan data maintenance');
        }
    }

    public function createMaintenanceLanjutan($maintenanceId)
    {
        try {
            $kondisiBarang = KondisiBarang::where('kondisi_barang', 'like', 'Maintenance Lanjutan')
                ->orWhere('kondisi_barang', 'like', 'maintenance lanjutan')
                ->firstOrFail();

            $vendors = Vendor::query()->where('nama_vendor', '!=', 'Default Kategori')->get();

            $maintenance = Maintenance::find($maintenanceId);
            return view('dashboard.admin.maintenance.maintenance_lanjut', compact('maintenance', 'kondisiBarang', 'vendors'));
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            // kondisi_barang 'Maintenance Lanjutan' atau 'maintenance lanjutan' tidak ditemukan
            // Anda bisa mengarahkan user ke halaman error atau memberikan pesan error
        }
    }

    public function updateMaintenanceLanjutan(Request $request, $id)
    {
        try {
            $request->validate([
                'catatan' => 'required',
                'harga' => 'required',
                'kondisi_barang_id' => 'required',
                'barang_id' => 'required',
                'vendor_id' => 'required',
            ]);

            $maintenanceData = $request->all();
            $maintenanceData['tanggal_maintenance_lanjutan'] = now()->format('Y-m-d H:i:s');
            Maintenance::find($id)->update($maintenanceData);

            $barang = Barang::find($request->barang_id);
            $barang->update([
                'kondisi_barang_id' => KondisiBarang::where('kondisi_barang', 'Maintenance Lanjutan')->first()->id
            ]);

            // Send message to all users except iprs and admin
//            $maintenance = Maintenance::find($id);
//            $excludedRoles = Role::whereIn('name', ['iprs', 'server'])->pluck('id');
//            $users = User::where('unit_kerja_id', $barang->unit_kerja_id)
//                ->whereNotIn('role_id', $excludedRoles)
//                ->get();
//            $unitKerja = UnitKerja::find($barang->unit_kerja_id);
//            $message = "Barang sedang dalam Maintenance Lanjutan" . "\n" .
//                "Barang: " . $barang->nama_barang . "\n" .
//                "Unit Kerja: " . $unitKerja->unit_kerja . "\n" .
//                "Alasan Rusak: " . $maintenance->alasan_rusak . "\n" .
//                "Catatan: " . $request->catatan . "\n" .
//                "Biaya Perbaikan / Vendor: " . "Rp" . number_format($request->harga) . "\n";
//
//            foreach ($users as $user) {
//                $this->fonnteService->sendMessage($user->phone, $message);
//            }

            return redirect()->route('maintenance.lanjutan.index')->with('success', 'Data maintenance lanjutan berhasil diupdate');
        } catch (\Exception $e) {
            Log::error('Error in MaintenanceController@updateMaintenanceLanjutan: ', ['error' => $e->getMessage()]);
            return back()->with('error', 'Terjadi kesalahan saat mengupdate data maintenance lanjutan');
        }
    }

    public function createMaintenanceRusak($maintenanceId)
    {
        try {
            $kondisiBarang = KondisiBarang::where('kondisi_barang', 'like', 'Rusak')
                ->orWhere('kondisi_barang', 'like', 'rusak')
                ->firstOrFail();

            $id = $kondisiBarang->id;

            $maintenance = Maintenance::find($maintenanceId);
            return view('dashboard.admin.maintenance.maintenance_rusak', compact('maintenance', 'kondisiBarang'));
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            // kondisi_barang 'Maintenance Lanjutan' atau 'maintenance lanjutan' tidak ditemukan
            // Anda bisa mengarahkan user ke halaman error atau memberikan pesan error
        }
    }

    public function updateMaintenanceRusak(Request $request, $id)
    {
        try {
            $maintenance = Maintenance::find($id);
            $barangId = $maintenance->barang_id;
            $barang = Barang::find($barangId);

            $rusakKondisiBarangId = KondisiBarang::where('kondisi_barang', 'Rusak')->first()->id;

            $barang->update([
                'kondisi_barang_id' => $rusakKondisiBarangId
            ]);

            $maintenance->update([
                'kondisi_barang_id' => $rusakKondisiBarangId,
                'catatan' => $request->catatan,
                'barang_id' => $request->barang_id,
                'disetujui' => auth()->user()->name,
            ]);

            // Send message to all users except iprs and admin
            $maintenance = Maintenance::find($id);
//            $excludedRoles = Role::whereIn('name', ['iprs', 'server'])->pluck('id');
//            $users = User::where('unit_kerja_id', $barang->unit_kerja_id)
//                ->whereNotIn('role_id', $excludedRoles)
//                ->get();
//            $unitKerja = UnitKerja::find($barang->unit_kerja_id);
//            $message = "Barang anda dinyatakan telah rusak" . "\n" .
//                "Barang: " . $barang->nama_barang . "\n" .
//                "Unit Kerja: " . $unitKerja->unit_kerja . "\n" .
//                "Alasan Rusak: " . $maintenance->alasan_rusak . "\n" .
//                "Catatan: " . $request->catatan . "\n";
//
//            foreach ($users as $user) {
//                $this->fonnteService->sendMessage($user->phone, $message);
//            }

            return redirect()->route('maintenance.rusak.index')->with('error', 'Barang gagal diperbaiki');
        } catch (\Exception $e) {
            Log::error('Error in MaintenanceController@destroy: ', ['error' => $e->getMessage()]);
            return back()->with('error', 'Terjadi kesalahan saat menghapus data maintenance');
        }
    }

    public function createBerhasilDiperbaiki($maintenanceId)
    {
        try {
            $kondisiBarang = KondisiBarang::where('kondisi_barang', 'like', 'Normal')
                ->orWhere('kondisi_barang', 'like', 'normal')
                ->firstOrFail();

            $id = $kondisiBarang->id;

            $maintenance = Maintenance::find($maintenanceId);
            return view('dashboard.admin.maintenance.maintenance_diperbaiki', compact('maintenance', 'kondisiBarang'));
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return redirect()->route('maintenance.index')->with('error', 'Maintenance or Kondisi Barang not found.');
        }
    }

    public function createBerhasilDiperbaikiLanjutan($maintenanceId)
    {
        try {
            $kondisiBarang = KondisiBarang::where('kondisi_barang', 'like', 'Normal')
                ->orWhere('kondisi_barang', 'like', 'normal')
                ->firstOrFail();

            $id = $kondisiBarang->id;

            $maintenance = Maintenance::find($maintenanceId);
            return view('dashboard.admin.maintenance.maintenance_diperbaiki_lanjutan', compact('maintenance', 'kondisiBarang'));
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return redirect()->route('maintenance.index')->with('error', 'Maintenance or Kondisi Barang not found.');
        }
    }
    public function updateMaintenanceDiperbaiki($id, Request $request)
    {
        try {
            $maintenance = Maintenance::find($id);
            $barangId = $maintenance->barang_id;
            $barang = Barang::find($barangId);

            $normalKondisiBarangId = KondisiBarang::where('kondisi_barang', 'Normal')->first()->id;
            $berhasilDiperbaikiKondisiBarangId = KondisiBarang::where('kondisi_barang', 'Berhasil Diperbaiki')->first()->id;

            $barang->update([
                'kondisi_barang_id' => $normalKondisiBarangId
            ]);

            $maintenance->update([
                'kondisi_barang_id' => $berhasilDiperbaikiKondisiBarangId,
                'catatan' => $request->catatan,
                'harga' => $request->harga,
                'barang_id' => $request->barang_id,
                'diperbaiki' => $request->diperbaiki,
                'disetujui' => auth()->user()->name,
            ]);

            // Send message to all users except iprs and admin
//            $maintenance = Maintenance::find($id);
//            $excludedRoles = Role::whereIn('name', ['iprs', 'server'])->pluck('id');
//            $users = User::where('unit_kerja_id', $barang->unit_kerja_id)
//                ->whereNotIn('role_id', $excludedRoles)
//                ->get();
//            $unitKerja = UnitKerja::find($barang->unit_kerja_id);
//            $message = "Barang berhasil diperbaiki" . "\n" .
//                "Barang: " . $barang->nama_barang . "\n" .
//                "Unit Kerja: " . $unitKerja->unit_kerja . "\n" .
//                "Alasan Rusak: " . $maintenance->alasan_rusak . "\n" .
//                "Catatan: " . $request->catatan . "\n" .
//                "Biaya Perbaikan / Vendor:" . "Rp" . number_format($request->harga) . "\n";
//
//            foreach ($users as $user) {
//                $this->fonnteService->sendMessage($user->phone, $message);
//            }

            return redirect()->route('maintenance.diperbaiki.index')->with('success', 'Barang berhasil diperbaiki');
        } catch (\Exception $e) {
            Log::error('Error in MaintenanceController@destroy: ', ['error' => $e->getMessage()]);
            return back()->with('error', 'Terjadi kesalahan saat menghapus data maintenance');
        }
    }
}
