<?php

namespace App\Http\Controllers\Admin\Logs;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LogKalibrasiBarangController extends Controller
{
    public function index()
    {
        $logs = DB::table('log_kalibrasi_barang')->orderBy('created_at', 'desc')->get();
        return view('dashboard.admin.logs.log_kalibrasi_barang.index', compact('logs'));
    }
}
