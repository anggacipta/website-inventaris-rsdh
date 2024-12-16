<?php

namespace App\Http\Controllers\Admin\Logs;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LogKalibrasiBarangController extends Controller
{
    public function index(Request $request)
    {
        $bulan = $request->input('bulan');
        $tahun = $request->input('tahun');
        $query = DB::table('log_kalibrasi_barang')->orderBy('created_at', 'desc');

        if ($bulan) {
            $query->whereMonth('created_at', $bulan);
        }

        if ($tahun) {
            $query->whereYear('created_at', $tahun);
        }
        $logs = $query->get();
        return view('dashboard.admin.logs.log_kalibrasi_barang.index', compact('logs'));
    }
}
