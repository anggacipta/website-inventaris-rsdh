<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\LogPersetujuanMaintenance;
use Illuminate\Http\Request;

class LogPersetujuanMaintenanceController extends Controller
{
    public function index()
    {
        $persetujuans = LogPersetujuanMaintenance::orderBy('updated_at', 'desc')->limit(500)->paginate(10);
        return view('dashboard.admin.logs.log_persetujuan_maintenance.index', compact('persetujuans'));
    }

    public function show($id) {
        $persetujuan = LogPersetujuanMaintenance::findOrFail($id);
        return view('dashboard.admin.logs.log_persetujuan_maintenance.show', compact('persetujuan'));
    }
}
