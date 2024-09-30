<?php

namespace App\Http\Controllers\Admin\Logs;

use App\Http\Controllers\Controller;
use App\Models\JenisBarang;
use App\Models\Maintenance;
use App\Models\UnitKerja;
use Illuminate\Http\Request;

class LogMaintenanceController extends Controller
{
    public function index(Request $request)
    {
        $query = Maintenance::query();

        if ($request->filled('unit_kerja')) {
            $query->whereHas('barang.unitKerja', function ($q) use ($request) {
                $q->where('unit_kerja', $request->unit_kerja);
            });
        }

        if ($request->filled('jenis_barang')) {
            $query->whereHas('barang.jenisBarang', function ($q) use ($request) {
                $q->where('jenis_barang', $request->jenis_barang);
            });
        }

        if ($request->filled('nama_barang')) {
            $query->whereHas('barang', function ($q) use ($request) {
                $q->where('nama_barang', 'like', '%' . $request->nama_barang . '%');
            });
        }

        $maintenances = $query->orderBy('updated_at', 'desc')->limit(100)->paginate(10);
        $unitKerjas = UnitKerja::query()->where('unit_kerja', '!=', 'Default Kategori')->get();
        $jenisBarangs = JenisBarang::query()->where('jenis_barang', '!=', 'Default Kategori')->get();

        return view('dashboard.admin.logs.log_maintenance.index', compact('maintenances', 'unitKerjas', 'jenisBarangs'));
    }
}
