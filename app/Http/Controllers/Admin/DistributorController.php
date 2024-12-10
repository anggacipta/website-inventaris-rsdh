<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Barang;
use App\Models\Distributor;
use Illuminate\Http\Request;

class DistributorController extends Controller
{
    public function index()
    {
        Distributor::ensureDefaultCategoryExists();
        $distributors = Distributor::all();
        return view('dashboard.admin.distributor.index', compact('distributors'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_distributor' => 'required',
        ]);

        // Format data ke uppercase
        $data = $request->all();

        // Buat distributor baru
        Distributor::create($data);

        return redirect()->route('distributor.index')
            ->with('success', 'Distributor berhasil ditambahkan');
    }

    public function edit($id)
    {
        $distributor = Distributor::find($id);
        return view('dashboard.admin.distributor.edit', compact('distributor'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_distributor' => 'required',
        ]);

        $distributor = Distributor::find($id);

        // Format data ke uppercase
        $data = $request->all();

        // Update data
        $distributor->update($data);

        return redirect()->route('distributor.index')
            ->with('success', 'Distributor berhasil diupdate');
    }

    public function destroy($id)
    {
        Distributor::ensureDefaultCategoryExists(); // Ensure default category exists

        $kategori = Distributor::find($id);
        if ($kategori) {
            // Update related records to default category
            Barang::where('distributor_id', $id)->update(['distributor_id' => 1]);
            $kategori->delete();
        }

        return redirect()->route('distributor.index')
            ->with('success', 'Distributor berhasil dihapus');
    }
}
