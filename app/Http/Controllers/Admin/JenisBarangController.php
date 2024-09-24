<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Barang;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use App\Models\JenisBarang;

class JenisBarangController extends Controller
{
    public function index()
    {
        JenisBarang::ensureDefaultCategoryExists();
        $jenis_barangs = JenisBarang::all();
        return view('dashboard.admin.jenis_barang.index', compact('jenis_barangs'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'jenis_barang' => 'required',
            'kode_barang' => 'required|regex:/^[a-zA-Z]+$/',
        ]);

        // Format data ke uppercase
        $data = $request->all();
        $data['kode_barang'] = strtoupper($data['kode_barang']);

        // Buat jenis barang baru
        JenisBarang::create($data);

        return redirect()->route('jenis-barang.index')
            ->with('success', 'Jenis Barang created successfully.');
    }

    public function edit($id)
    {
        $jenis_barang = JenisBarang::find($id);
        return view('dashboard.admin.jenis_barang.edit', compact('jenis_barang'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'jenis_barang' => 'required',
            'kode_barang' => 'required|regex:/^[a-zA-Z]+$/',
        ]);

        $jenis_barang = JenisBarang::find($id);

        // Format data ke uppercase
        $data = $request->all();
        $data['kode_barang'] = strtoupper($data['kode_barang']);

        // Update data
        $jenis_barang->update($data);

        return redirect()->route('jenis-barang.index')
            ->with('success', 'Jenis Barang updated successfully');
    }

    public function destroy($id)
    {
        JenisBarang::ensureDefaultCategoryExists(); // Ensure default category exists

        $kategori = JenisBarang::find($id);
        if ($kategori) {
            // Update related records to default category
            Barang::where('jenis_barang_id', $id)->update(['jenis_barang_id' => 1]);
            $kategori->delete();
        }

        return redirect()->route('jenis-barang.index')
            ->with('success', 'Jenis Barang deleted successfully');
    }
}
