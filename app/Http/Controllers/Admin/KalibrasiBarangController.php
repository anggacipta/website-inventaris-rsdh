<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Barang;
use App\Models\JenisBarang;
use App\Models\UnitKerja;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class KalibrasiBarangController extends Controller
{
    public function index(Request $request)
    {
        $user = auth()->user();
        $unitKerjaId = $user->unit_kerja_id;
        $search = $request->input('search');
        $unitKerja = $request->input('unit_kerja');
        $jenisBarang = $request->input('jenis_barang');
        $bulan = $request->input('bulan');
        $tahun = $request->input('tahun');

        $query = Barang::query();

        // Filter Barang by search and select query
        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('nama_barang', 'like', '%' . $search . '%')
                    ->orWhere('kode_barang', 'like', '%' . $search . '%')
                    ->orWhere('distributor', 'like', '%' . $search . '%');
            });
        }

        if ($unitKerja) {
            $query->whereHas('unitKerja', function ($q) use ($request) {
                $q->where('unit_kerja', $request->unit_kerja);
            });
        }

        if ($jenisBarang) {
            $query->whereHas('jenisBarang', function ($q) use ($request) {
                $q->where('jenis_barang', $request->jenis_barang);
            });
        }

        if ($bulan) {
            $query->whereMonth('tanggal_kalibrasi', $bulan);
        }

        if ($tahun) {
            $query->whereYear('tanggal_kalibrasi', $tahun);
        }
        // End

        $barangs = $query->with(['unitKerja', 'jenisBarang', 'merkBarang', 'distributors'])
            ->whereHas('kondisiBarang', function ($q) {
                $q->where('kondisi_barang', '!=', 'Rusak')
                ->where('kondisi_barang', '!=', 'Digantikan');
            })
            ->orderBy('created_at', 'desc')->paginate(10);
        $barangs->getCollection()->transform(function ($barang) {
            $barang->formatted_tanggal_kalibrasi = $barang->tanggal_kalibrasi
                ? Carbon::parse($barang->tanggal_kalibrasi)->translatedFormat('d F Y')
                : 'Tidak ada tanggal Kalibrasi';
            return $barang;
        });

        $unitKerjas = UnitKerja::query()->where('unit_kerja', '!=', 'Default Kategori')->get();
        $jenisBarangs = JenisBarang::query()->where('jenis_barang', '!=', 'Default Kategori')->get();

        return view('dashboard.admin.kalibrasi_barang.index', compact('barangs', 'unitKerjas', 'jenisBarangs'));
    }

    public function editKalibrasi($id)
    {
        $barang = Barang::query()->with('unitKerja')->find($id);

        return view('dashboard.admin.kalibrasi_barang.edit', compact('barang'));
    }

    public function updateKalibrasi(Request $request, $id)
    {
        $barangData = $request->validate([
           'tanggal_kalibrasi' => 'required|date',
           'no_sertifikat' => 'required|string',
        ]);

        $barang = Barang::find($id);

        // Menambahkan log kalibrasi barang sebelum update data barang
        DB::table('log_kalibrasi_barang')->insert([
            'nama_barang' => $request->nama_barang,
            'unit_kerja' => $request->unit_kerja,
            'kode_barang' => $request->kode_barang,
            'tanggal_kalibrasi' => $barang->tanggal_kalibrasi ?? 'Tidak ada tanggal kalibrasi',
            'no_sertifikat' => $barangData['no_sertifikat'],
            'created_at' => now(),
            'updated_at' => now()
        ]);

        // Update data barang
        $barang->update($barangData);

        return redirect()->route('kalibrasi.barang.index')->with('success', 'Data kalibrasi barang berhasil diupdate');
    }
}
