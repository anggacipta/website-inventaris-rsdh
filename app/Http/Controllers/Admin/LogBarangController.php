<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Barang;
use App\Models\LogBarang;
use Illuminate\Http\Request;

class LogBarangController extends Controller
{
    public function index()
    {
        $logs = LogBarang::all();
        return view('dashboard.admin.log_barang.index', compact('logs'));
    }

    public function create($id)
    {
        $barang = Barang::find($id);
        return view('dashboard.admin.log_barang.create', compact('barang'));
    }

    public function store(Request $request, $id)
    {
        $request->validate([
            'nama_barang' => 'required',
            'unit_kerja' => 'required',
            'keterangan' => 'required'
        ]);

        LogBarang::create([
            'id_barang' => $id,
            'nama_barang' => $request->nama_barang,
            'unit_kerja' => $request->unit_kerja,
            'keterangan' => $request->keterangan
        ]);

        $barang = Barang::find($id);
        $barang->delete();

        return redirect()->route('barang.index')->with('error', 'Barang telah dihapus');
    }
}
