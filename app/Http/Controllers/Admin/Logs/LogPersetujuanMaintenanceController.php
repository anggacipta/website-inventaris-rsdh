<?php

namespace App\Http\Controllers\Admin\Logs;

use App\Http\Controllers\Controller;
use App\Models\LogPersetujuanMaintenance;

class LogPersetujuanMaintenanceController extends Controller
{
    public function index()
    {
        $persetujuans = LogPersetujuanMaintenance::orderBy('created_at', 'desc')->limit(100)->paginate(10);
        return view('dashboard.admin.logs.log_persetujuan_maintenance.index', compact('persetujuans'));
    }

    public function show($id) {
        $persetujuan = LogPersetujuanMaintenance::findOrFail($id);
        return view('dashboard.admin.logs.log_persetujuan_maintenance.show', compact('persetujuan'));
    }
}
