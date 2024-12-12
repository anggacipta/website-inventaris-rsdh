<?php

namespace App\Http\Controllers\Admin\Logs;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LogBarangTambahController extends Controller
{
    public function index()
    {
        $logs = DB::table('log_barang_tambah')->orderBy('created_at', 'desc')->get();
        return view('dashboard.admin.logs.log_barang_tambah.index', compact('logs'));
    }
}
