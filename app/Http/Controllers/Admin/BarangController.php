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
    public function index()
    {
        $user = auth()->user();
        $unitKerjaId = $user->unit_kerja_id;

        if (in_array($unitKerjaId, [UnitKerja::where('unit_kerja', 'Logistik')->first()->id, UnitKerja::where('unit_kerja', 'IPSRS')->first()->id])) {
//            $barangs = Barang::whereHas('kondisiBarang', function ($query) {
//               $query->where('kondisi_barang', '!=', 'Rusak');
//            })->paginate(10);
            $barangs = Barang::query()->paginate(10);
        } else {
            $barangs = Barang::where('unit_kerja_id', $unitKerjaId)
                ->whereHas('kondisiBarang', function ($query) {
                    $query->where('kondisi_barang', '!=', 'Rusak');
                })
                ->paginate(10);
        }

        return view('dashboard.admin.barang.index', compact('barangs'));
    }

    public function create()
    {
//        $totalBarang = Barang::where('ruang_id', $ruangan_id)->count() + 1;
//        $kode_barang = 'BRG' . str_pad($totalBarang, 3, '0', STR_PAD_LEFT);
        $unit_kerjas = UnitKerja::all();
        $merk_barangs = MerkBarang::all();
        $jenis_barangs = JenisBarang::all();
        $kondisi_barangs = KondisiBarang::all();
        $sumber_pengadaans = SumberPengadaan::all();
        return view('dashboard.admin.barang.create', compact('unit_kerjas', 'merk_barangs',
            'jenis_barangs', 'kondisi_barangs', 'sumber_pengadaans'));
    }

    public function ruangan(Request $request)
    {
        $search = $request->get('search');
        $ruangans = Ruangan::where('nama_ruang', 'like', "%$search%")->get();
        return view('dashboard.admin.barang.ruangan', compact('ruangans'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_barang' => 'required',
            'kode_barang' => 'required',
            'unit_kerja_id' => 'required',
            'kondisi_barang_id' => 'required',
            'jenis_barang_id' => 'required',
            'merk_barang_id' => 'required',
            'sumber_pengadaan_id' => 'required',
            'tahun_pengadaan' => 'required|date_format:m/d/Y',
            'harga' => 'required',
            'photo' => 'required|image|mimes:jpeg,png,jpg,gif,svg,webp|max:4096',
        ]);

        $barangData = $request->all();

        // Convert 'tahun_pengadaan' to 'YYYY-MM-DD' format
        $barangData['tahun_pengadaan'] = Carbon::createFromFormat('m/d/Y', $request->tahun_pengadaan)->format('Y-m-d');

        if ($request->hasFile('photo')) {
            $imageName = time().'.'.$request->photo->extension(); // Menambahkan timestamp ke nama file
            $request->photo->move(public_path('images'), $imageName);
            $barangData['photo'] = $imageName;
        }

        Barang::create($barangData);

        return redirect()->back()->with('success', 'Barang berhasil ditambahkan');
    }

    public function edit($id)
    {
        $barang = Barang::find($id);
        $unit_kerjas = UnitKerja::all();
        $merk_barangs = MerkBarang::all();
        $jenis_barangs = JenisBarang::all();
        $kondisi_barangs = KondisiBarang::all();
        $sumber_pengadaans = SumberPengadaan::all();
        return view('dashboard.admin.barang.edit', compact('barang', 'unit_kerjas', 'merk_barangs',
            'jenis_barangs', 'kondisi_barangs', 'sumber_pengadaans'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_barang' => 'required',
            'kode_barang' => 'required',
            'unit_kerja_id' => 'required',
//            'kondisi_barang_id' => 'required',
            'jenis_barang_id' => 'required',
            'merk_barang_id' => 'required',
            'sumber_pengadaan_id' => 'required',
            'tahun_pengadaan' => 'required|date_format:m/d/Y',
            'harga' => 'required',
            'photo' => 'image|mimes:jpeg,png,jpg,gif,svg,webp|max:4096',
        ]);

        $barang = Barang::find($id);
        $barangData = $request->all();

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
            // Delete the file if it exists
            $filePath = public_path('images/' . $barang->photo);
            if (file_exists($filePath)) {
                unlink($filePath);
            }

            // Delete the Barang instance
            $barang->delete();

            return redirect()->route('barang.index')->with('error', 'Barang berhasil dihapus');
        }

        return redirect()->route('barang.index')->with('error', 'Barang tidak ditemukan');
    }

    public function countByUnitKerja($unitKerjaId)
    {
        $count = Barang::where('unit_kerja_id', $unitKerjaId)->count();
        return response()->json(['count' => $count]);
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
