<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Barang;
use App\Models\JenisBarang;
use App\Models\KondisiBarang;
use App\Models\MerkBarang;
use App\Models\Ruangan;
use App\Models\SumberPengadaan;
use App\Models\UnitKerja;
use Barryvdh\DomPDF\Facade\Pdf;
use TCPDF;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class BarangController extends Controller
{
    public function index(Request $request)
    {
        $user = auth()->user();
        $unitKerjaId = $user->unit_kerja_id;
        $search = $request->input('search');

        $query = Barang::query();

        if ($search) {
            $query->where('nama_barang', 'like', '%' . $search . '%')
                ->orWhere('kode_barang', 'like', '%' . $search . '%')
                ->orWhere('distributor', 'like', '%' . $search . '%');
        }

        if (in_array($unitKerjaId, [UnitKerja::where('unit_kerja', 'Logistik')->first()->id, UnitKerja::where('unit_kerja', 'IPSRS')->first()->id])) {
            $barangs = $query->withoutTrashed()->orderBy('created_at', 'desc')->limit(200)->paginate(10);
        } else {
            $barangs = $query->where('unit_kerja_id', $unitKerjaId)
                ->whereHas('kondisiBarang', function ($query) {
                    $query->where('kondisi_barang', '!=', 'Rusak');
                })
                ->withoutTrashed()->orderBy('created_at', 'desc')->limit(200)->paginate(10);
        }

        return view('dashboard.admin.barang.index', compact('barangs'));
    }

    public function trash()
    {
        $barangs = Barang::onlyTrashed()->paginate(10);
        return view('dashboard.admin.barang.index_barang_dihapus', compact('barangs'));
    }

    public function restore($id)
    {
        $barang = Barang::withTrashed()->find($id);

        if ($barang) {
            $barang->restore();
            return redirect()->route('barang.index')->with('success', 'Barang berhasil dipulihkan');
        }

        return redirect()->route('barang.index')->with('error', 'Barang tidak ditemukan');
    }

    public function create()
    {
        $unit_kerjas = UnitKerja::query()->where('unit_kerja', '!=', 'Default Kategori')->get();
        $merk_barangs = MerkBarang::query()->where('merk_barang', '!=', 'Default Kategori')->get();
        $jenis_barangs = JenisBarang::query()->where('jenis_barang', '!=', 'Default Kategori')->get();
        $kondisi_barangs = KondisiBarang::query()->where('kondisi_barang', '!=', 'Default Kategori')->get();
        $sumber_pengadaans = SumberPengadaan::query()->where('sumber_pengadaan', '!=', 'Default Kategori')->get();
        return view('dashboard.admin.barang.create', compact('unit_kerjas', 'merk_barangs',
            'jenis_barangs', 'kondisi_barangs', 'sumber_pengadaans'));
    }

    public function store(Request $request)
    {
        $barangData = $request->validate([
            'nama_barang' => 'required',
            'kode_barang' => 'required',
            'unit_kerja_id' => 'required',
            'kondisi_barang_id' => 'required',
            'jenis_barang_id' => 'required',
            'merk_barang_id' => 'required',
            'sumber_pengadaan_id' => 'required',
            'tahun_pengadaan' => 'required|date_format:m/d/Y',
            'harga' => 'required',
            'no_seri' => 'nullable',
            'tahun' => 'required',
            'keterangan' => 'nullable',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:4096',
        ]);

        // Convert 'tahun_pengadaan' to 'YYYY-MM-DD' format
        $barangData['tahun_pengadaan'] = Carbon::createFromFormat('m/d/Y', $request->tahun_pengadaan)->format('Y-m-d');

        if ($request->hasFile('photo')) {
            $imageName = time().'.'.$request->photo->extension(); // Menambahkan timestamp ke nama file
            $request->photo->move(public_path('images'), $imageName);
            $barangData['photo'] = $imageName;
        } else {
            $barangData['photo'] = 'no_image.png';
        }

        Barang::create($barangData);

        return redirect()->back()->with('success', 'Barang berhasil ditambahkan');
    }

    public function edit($id)
    {
        $barang = Barang::find($id);
        $unit_kerjas = UnitKerja::query()->where('unit_kerja', '!=', 'Default Kategori')->get();
        $merk_barangs = MerkBarang::query()->where('merk_barang', '!=', 'Default Kategori')->get();
        $jenis_barangs = JenisBarang::query()->where('jenis_barang', '!=', 'Default Kategori')->get();
        $kondisi_barangs = KondisiBarang::query()->where('kondisi_barang', '!=', 'Default Kategori')->get();
        $sumber_pengadaans = SumberPengadaan::query()->where('sumber_pengadaan', '!=', 'Default Kategori')->get();
        return view('dashboard.admin.barang.edit', compact('barang', 'unit_kerjas', 'merk_barangs',
            'jenis_barangs', 'kondisi_barangs', 'sumber_pengadaans'));
    }

    public function update(Request $request, $id)
    {
        $barangData = $request->validate([
            'nama_barang' => 'required',
            'kode_barang' => 'required',
            'unit_kerja_id' => 'required',
            'jenis_barang_id' => 'required',
            'merk_barang_id' => 'required',
            'sumber_pengadaan_id' => 'required',
            'tahun_pengadaan' => 'required|date_format:m/d/Y',
            'harga' => 'required',
            'keterangan' => 'nullable',
            'photo' => 'image|mimes:jpeg,png,jpg,gif,svg,webp|max:4096',
        ]);

        $barang = Barang::find($id);

        // Convert 'tahun_pengadaan' to 'YYYY-MM-DD' format
        $barangData['tahun_pengadaan'] = Carbon::createFromFormat('m/d/Y', $request->tahun_pengadaan)->format('Y-m-d');

        if ($request->hasFile('photo')) {
            // Delete the old photo if it exists
            if ($barang->photo) {
                $oldPhotoPath = public_path('images/' . $barang->photo);
                if (file_exists($oldPhotoPath)) {
                    unlink($oldPhotoPath);
                }
            }

            // Save the new photo
            $imageName = time().'.'.$request->photo->extension(); // Add timestamp to the filename
            $request->photo->move(public_path('images'), $imageName);
            $barangData['photo'] = $imageName;
        }

        $barang->update($barangData);

        return redirect()->route('barang.index')->with('success', 'Barang berhasil diubah');
    }

    public function destroy($id)
    {
        $barang = Barang::find($id);

        if ($barang) {
            // Delete the Barang instance
            $barang->delete();

            return redirect()->route('barang.index')->with('error', 'Barang berhasil dihapus');
        }

        return redirect()->route('barang.index')->with('error', 'Barang tidak ditemukan');
    }

    public function destroyPermanent($id)
    {
        $barang = Barang::withTrashed()->find($id);

        if ($barang) {
            // Delete the file if it exists
            $filePath = public_path('images/' . $barang->photo);
            if (file_exists($filePath)) {
                unlink($filePath);
            }

            // Delete the Barang instance
            $barang->forceDelete();

            return redirect()->route('barang.trash')->with('error', 'Barang berhasil dihapus secara permanen');
        }

        return redirect()->route('barang.index')->with('error', 'Barang tidak ditemukan');
    }

    public function countByUnitKerja($unitKerjaId)
    {
        $count = Barang::where('unit_kerja_id', $unitKerjaId)->count();
        return response()->json(['count' => $count]);
    }

    public function getKodeBarang($unitKerjaId, $jenisBarangId, $tahunPengadaan, $id = null)
    {
        $unitKerja = UnitKerja::find($unitKerjaId);
        $jenisBarang = JenisBarang::find($jenisBarangId);

        if ($unitKerja && $jenisBarang) {
            if ($id) {
                $barang = Barang::find($id);
                if ($barang) {
                    $unitKerjaChanged = $barang->unit_kerja_id != $unitKerjaId;
                    $jenisBarangChanged = $barang->jenis_barang_id != $jenisBarangId;
                    $tahunPengadaanChanged = $barang->tahun_pengadaan != $tahunPengadaan;

                    if (!$unitKerjaChanged && !$jenisBarangChanged && !$tahunPengadaanChanged) {
                        return response()->json(['kode_barang' => $barang->kode_barang]);
                    }

                    $totalBarangByUnitKerja = $unitKerjaChanged ? Barang::where('unit_kerja_id', $unitKerjaId)->count() + 1 : Barang::where('unit_kerja_id', $unitKerjaId)->count();
                    $totalBarangByJenisBarang = $jenisBarangChanged ? Barang::where('jenis_barang_id', $jenisBarangId)->count() + 1 : Barang::where('jenis_barang_id', $jenisBarangId)->count();
                }
            } else {
                $totalBarangByUnitKerja = Barang::where('unit_kerja_id', $unitKerjaId)->count() + 1;
                $totalBarangByJenisBarang = Barang::where('jenis_barang_id', $jenisBarangId)->count() + 1;
            }

            $kodeBarang = sprintf('%s-%s-%03d%03d-%s', $unitKerja->kode_barang, $jenisBarang->kode_barang, $totalBarangByUnitKerja, $totalBarangByJenisBarang, $tahunPengadaan);
            return response()->json(['kode_barang' => $kodeBarang]);
        } else {
            return response()->json(['error' => 'Unit Kerja or Jenis Barang not found'], 404);
        }
    }

    public function printSticker($id)
    {
        $barang = Barang::findOrFail($id);
//        $pdf = Pdf::loadView('dashboard.admin.barang.print_sticker', compact('barang'));
//        return $pdf->stream('sticker.pdf');
        return view('dashboard.admin.barang.print_sticker', compact('barang'));
    }

    public function printStickerAll()
    {
        $barangs = Barang::all();
//        $pdf = Pdf::loadView('dashboard.admin.barang.print_sticker_all', compact('barangs'));
//        return $pdf->stream('sticker_all.pdf');
        return view('dashboard.admin.barang.print_sticker_all', compact('barangs'));
    }
}