<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Barang;
use App\Models\UnitKerja;
use App\Models\User;
use Illuminate\Http\Request;

class UnitKerjaController extends Controller
{
    public function index()
    {
        UnitKerja::ensureDefaultCategoryExists();
        $units = UnitKerja::all();
        return view('dashboard.admin.unit_kerja.index', compact('units'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'unit_kerja' => 'required',
            'kode_barang' => 'required|regex:/^[a-zA-Z]+$/',
        ]);

        // Format data ke uppercase
        $data = $request->all();
        $data['kode_barang'] = strtoupper($data['kode_barang']); // Convert to uppercase

        // Create new unit
        UnitKerja::create($data);

        return redirect()->route('unit-kerja.index')
            ->with('success', 'Unit Kerja created successfully.');
    }

    public function edit($id)
    {
        $unit = UnitKerja::find($id);
        return view('dashboard.admin.unit_kerja.edit', compact('unit'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'unit_kerja' => 'required',
            'kode_barang' => 'required|regex:/^[a-zA-Z]+$/',
        ]);

        $unit = UnitKerja::find($id);

        // Format data ke uppercase
        $data = $request->all();
        $data['kode_barang'] = strtoupper($data['kode_barang']); // Convert to uppercase

        // Update data
        $unit->update($data);

        return redirect()->route('unit-kerja.index')
            ->with('success', 'Unit Kerja updated successfully');
    }

    public function destroy($id)
    {
        UnitKerja::ensureDefaultCategoryExists(); // Ensure default category exists

        $kategori = UnitKerja::find($id);
        if ($kategori) {
            // Update related records to default category
             Barang::where('unit_kerja_id', $id)->update(['unit_kerja_id' => 1]);
             User::where('unit_kerja_id', $id)->update(['unit_kerja_id' => 1]);
            $kategori->delete();
        }

        UnitKerja::find($id)->delete();
        return redirect()->route('unit-kerja.index')
            ->with('success', 'Unit Kerja deleted successfully');
    }
}
