<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\KondisiBarang;
use App\Models\Vendor;
use Illuminate\Http\Request;

class VendorController extends Controller
{
    public function index()
    {
        $vendors = Vendor::query()->limit(50)->get();
        return view('dashboard.admin.vendor.index', compact('vendors'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_vendor' => 'required',
        ]);

        Vendor::create($request->all());
        return redirect()->route('vendor.index')->with('success', 'Vendor berhasil ditambahkan');
    }

    public function edit($id)
    {
        $vendor = Vendor::find($id);
        return view('dashboard.admin.vendor.edit', compact('vendor'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_vendor' => 'required',
        ]);

        $vendor = Vendor::find($id);
        $vendor->update($request->all());

        return redirect()->route('vendor.index')
            ->with('success', 'Vendor updated successfully');
    }

    public function destroy($id)
    {
        Vendor::find($id)->delete();
        return redirect()->route('vendor.index')
            ->with('success', 'Vendor deleted successfully');
    }
}
