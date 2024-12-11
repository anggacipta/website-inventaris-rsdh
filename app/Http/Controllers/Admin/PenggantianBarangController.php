<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Barang;
use App\Models\KondisiBarang;
use App\Models\Maintenance;
use Illuminate\Http\Request;

class PenggantianBarangController extends Controller
{
    public function index()
    {
        $maintenances = Maintenance::query()
            ->whereHas('kondisiBarang', function ($query) {
                $query->where('kondisi_barang', 'like', 'Digantikan')
                    ->orWhere('kondisi_barang', 'like', 'digantikan');
            })
            ->with('barang')
            ->get();
        return view('dashboard.admin.penggantian_barang.index', compact('maintenances'));
    }

    public function edit($id)
    {
        $kondisiBarang = KondisiBarang::where('kondisi_barang', 'like', 'Digantikan')
            ->orWhere('kondisi_barang', 'like', 'digantikan')
            ->firstOrFail();
        $maintenance = Maintenance::query()->find($id);
        $barangs = Barang::query()->select('id', 'nama_barang', 'kode_barang')->get();
        return view('dashboard.admin.penggantian_barang.edit', compact('maintenance', 'kondisiBarang', 'barangs'));
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'alasan_diganti' => 'required',
            'penggantian_barang_id' => 'required',
            'kondisi_barang_id' => 'required',
            'barang_id' => 'required',
        ]);

        $maintenance = Maintenance::find($id);
        if ($maintenance) {
            $maintenance->update([
                'alasan_diganti' => $validatedData['alasan_diganti'],
                'penggantian_barang_id' => $validatedData['penggantian_barang_id'],
                'kondisi_barang_id' => $validatedData['kondisi_barang_id'],
            ]);

            $barang = Barang::find($request->barang_id);
            if ($barang) {
                $barang->update([
                    'kondisi_barang_id' => $validatedData['kondisi_barang_id'],
                ]);
            }

            return redirect()->route('penggantian.barang.index')->with('success', 'Barang berhasil digantikan');
        }

        return redirect()->route('penggantian.barang.index')->with('error', 'Maintenance not found');
    }
}
