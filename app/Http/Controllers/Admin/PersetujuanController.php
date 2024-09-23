<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\PersetujuanDirektur;
use App\Http\Requests\PersetujuanStaff;
use App\Models\KondisiBarang;
use App\Models\LogPersetujuanMaintenance;
use App\Models\Maintenance;
use Illuminate\Http\Request;

class PersetujuanController extends Controller
{
    public function createPersetujuanStaff($id)
    {
        $maintenance = Maintenance::findOrFail($id);
        return view('dashboard.admin.persetujuan.disetujui_staff', compact('maintenance'));
    }

    public function createPertidaksetujuanStaff($id)
    {
        $maintenance = Maintenance::findOrFail($id);
        return view('dashboard.admin.persetujuan.tidak_disetujui_staff', compact('maintenance'));
    }

    public function createPersetujuanDirektur($id)
    {
        $maintenance = Maintenance::findOrFail($id);
        return view('dashboard.admin.persetujuan.disetujui_direktur', compact('maintenance'));
    }

    public function createPertidaksetujuanDirektur($id)
    {
        $maintenance = Maintenance::findOrFail($id);
        return view('dashboard.admin.persetujuan.tidak_disetujui_direktur', compact('maintenance'));
    }

    public function storePersetujuanStaff(PersetujuanStaff $request, $id)
    {
        LogPersetujuanMaintenance::create([
            'id_barang' => $request->kode_barang,
            'nama_barang' => $request->nama_barang,
            'unit_kerja' => $request->unit_kerja,
            'persetujuan_staff_ahli' => 1,
            'catatan_staff' => $request->catatan_staff_ahli,
            'catatan_direktur' => null,
            'harga_vendor' => $request->harga_vendor,
            'tanggal_maintenance' => $request->tanggal_maintenance,
            'tanggal_maintenance_lanjutan' => $request->tanggal_maintenance_lanjutan
        ]);

        Maintenance::findOrFail($id)->update([
            'persetujuan_staff_ahli' => 1,
            'catatan_staff' => $request->catatan_staff_ahli
        ]);

        return redirect()->route('maintenance.lanjutan.index')->with('success', 'Persetujuan berhasil disetujui');
    }

    public function storePertidaksetujuanStaff(PersetujuanStaff $request, $id)
    {
        LogPersetujuanMaintenance::create([
            'id_barang' => $request->kode_barang,
            'nama_barang' => $request->nama_barang,
            'unit_kerja' => $request->unit_kerja,
            'persetujuan_staff_ahli' => 0,
            'persetujuan_direktur' => 0,
            'catatan_staff' => $request->catatan_staff_ahli,
            'catatan_direktur' => null,
            'harga_vendor' => $request->harga_vendor,
            'tanggal_maintenance' => $request->tanggal_maintenance,
            'tanggal_maintenance_lanjutan' => $request->tanggal_maintenance_lanjutan
        ]);

        $kondisi = KondisiBarang::query()->where('kondisi_barang', 'Maintenance')->first()->id;

        Maintenance::findOrFail($id)->update([
            'persetujuan_staff_ahli' => null,
            'catatan' => '',
            'kondisi_barang_id' => $kondisi,
            'catatan_staff' => $request->catatan_staff_ahli,
            'harga' => null
        ]);

        return redirect()->route('maintenance.lanjutan.index')->with('error', 'Persetujuan tidak disetujui');
    }

    public function storePersetujuanDirektur(PersetujuanDirektur $request, $id)
    {
        $maintenance = Maintenance::findOrFail($id);
        $maintenance->update([
            'persetujuan_direktur' => 1,
            'catatan_direktur' => $request->catatan_direktur
        ]);

        LogPersetujuanMaintenance::create([
            'id_barang' => $request->kode_barang,
            'nama_barang' => $request->nama_barang,
            'unit_kerja' => $request->unit_kerja,
            'persetujuan_staff_ahli' => 1,
            'persetujuan_direktur' => 1,
            'harga_vendor' => $request->harga_vendor,
            'catatan_direktur' => $request->catatan_direktur,
            'tanggal_maintenance' => $request->tanggal_maintenance,
            'tanggal_maintenance_lanjutan' => $request->tanggal_maintenance_lanjutan
        ]);

        return redirect()->route('maintenance.lanjutan.index')->with('success', 'Persetujuan berhasil disetujui');
    }

    public function storePertidaksetujuanDirektur(PersetujuanDirektur $request, $id)
    {
        $maintenance = Maintenance::findOrFail($id);

        LogPersetujuanMaintenance::create([
            'id_barang' => $request->kode_barang,
            'nama_barang' => $request->nama_barang,
            'unit_kerja' => $request->unit_kerja,
            'persetujuan_staff_ahli' => 1,
            'persetujuan_direktur' => 0,
            'harga_vendor' => $request->harga_vendor,
            'catatan_direktur' => $request->catatan_direktur,
            'tanggal_maintenance' => $request->tanggal_maintenance,
            'tanggal_maintenance_lanjutan' => $request->tanggal_maintenance_lanjutan
        ]);

        $kondisi = KondisiBarang::query()->where('kondisi_barang', 'Maintenance')->first()->id;

        Maintenance::findOrFail($id)->update([
            'persetujuan_staff_ahli' => null,
            'persetujuan_direktur' => null,
            'catatan' => '',
            'kondisi_barang_id' => $kondisi,
            'catatan_direktur' => $request->catatan_direktur,
            'harga' => null
        ]);

        return redirect()->route('maintenance.lanjutan.index')->with('error', 'Persetujuan tidak disetujui');
    }
}
