<?php

namespace App\Http\Controllers\Admin\Logs;

use App\Http\Controllers\Controller;
use App\Models\Barang;
use App\Models\LogBarang;
use Illuminate\Http\Request;

class LogBarangHapusController extends Controller
{
    public function index(Request $request)
    {
        $bulan = $request->input('bulan');
        $tahun = $request->input('tahun');
        $query = LogBarang::query();

        if ($bulan) {
            $query->whereMonth('created_at', $bulan);
        }

        if ($tahun) {
            $query->whereYear('created_at', $tahun);
        }

        $logs = $query->orderBy('created_at', 'desc')->paginate(10)->appends($request->except('page'));
        return view('dashboard.admin.logs.log_barang_hapus.index', compact('logs'));
    }

    public function create($id)
    {
        $barang = Barang::find($id);
        return view('dashboard.admin.logs.log_barang_hapus.create', compact('barang'));
    }

    public function store(Request $request, $id)
    {
        $request->validate([
            'nama_barang' => 'required',
            'unit_kerja' => 'required',
            'keterangan' => 'required'
        ]);

        LogBarang::create([
            'id_barang' => $request->kode_barang,
            'nama_barang' => $request->nama_barang,
            'unit_kerja' => $request->unit_kerja,
            'keterangan' => $request->keterangan
        ]);

        $barang = Barang::find($id);
        $barang->delete();

        return redirect()->route('barang.index')->with('error', 'Barang telah dihapus');
    }
}
