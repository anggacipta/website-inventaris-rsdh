<?php

namespace App\Http\Controllers\Admin\Logs;

use App\Http\Controllers\Controller;
use App\Models\LogPersetujuanMaintenance;
use Illuminate\Http\Request;

class LogPersetujuanMaintenanceController extends Controller
{
    public function index(Request $request)
    {
        $bulan = $request->input('bulan');
        $tahun = $request->input('tahun');
        $query = LogPersetujuanMaintenance::query();

        if ($bulan) {
            $query->whereMonth('created_at', $bulan);
        }

        if ($tahun) {
            $query->whereYear('created_at', $tahun);
        }

        $persetujuans = $query->orderBy('created_at', 'desc')->paginate(10)->appends($request->except('page'));
        return view('dashboard.admin.logs.log_persetujuan_maintenance.index', compact('persetujuans'));
    }

    public function show($id) {
        $persetujuan = LogPersetujuanMaintenance::findOrFail($id);
        return view('dashboard.admin.logs.log_persetujuan_maintenance.show', compact('persetujuan'));
    }
}
