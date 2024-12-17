<?php

namespace App\Http\Controllers\Admin;

use App\Exports\BarangExport;
use App\Exports\MaintenanceExport;
use App\Http\Controllers\Controller;
use App\Models\Barang;
use App\Models\LogBarang;
use App\Models\LogPersetujuanMaintenance;
use App\Models\Maintenance;
use App\Service\ExportService;
use Barryvdh\DomPDF\Facade\Pdf;
use Dompdf\Options;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;

class ExportLaporanController extends Controller
{
    protected $format;
    protected $exportService;

    public function __construct(ExportService $exportService)
    {
        $this->middleware('auth');
        $this->exportService = $exportService;
    }

    public function export(Request $request)
    {
        $this->format = $request->format_export;
        $unitKerja = $request->unit_kerja;
        $tahun = $request->tahun;
        $jenisBarang = $request->jenis_barang;

        $query = Barang::with('jenisBarang', 'merkBarang', 'kondisiBarang', 'sumberPengadaan', 'unitKerja', 'distributors');

        if ($unitKerja) {
            $query->whereHas('unitKerja', function ($q) use ($unitKerja) {
                $q->where('unit_kerja', $unitKerja);
            });
        }

        if ($jenisBarang) {
            $query->whereHas('jenisBarang', function ($q) use ($jenisBarang) {
                $q->where('jenis_barang', $jenisBarang);
            });
        }

        if ($tahun) {
            $query->where('tahun', $tahun);
        }

        $barangs = $query->withoutTrashed()->limit(100)->get();

        if ($this->format === 'pdf') {
            $options = new Options();
            $options->set('isRemoteEnabled', true);
            $pdf = Pdf::loadView('dashboard.admin.barang.pdf', compact('barangs'))->setPaper('a3', 'landscape');
            return $pdf->download('laporan_barang.pdf');
        } elseif ($this->format === 'excel') {
            return Excel::download(new BarangExport($barangs), 'laporan_barang.xlsx');
        }

        return redirect()->back()->with('error', 'Format tidak valid');
    }

    public function exportOnlyTrashed(Request $request)
    {
        $this->format = $request->format_export;
        $unitKerja = $request->unit_kerja;
        $jenisBarang = $request->jenis_barang;
        $tahun = $request->tahun;

        $query = Barang::with('jenisBarang', 'merkBarang', 'kondisiBarang', 'sumberPengadaan', 'unitKerja', 'distributors');

        if ($unitKerja) {
            $query->whereHas('unitKerja', function ($q) use ($unitKerja) {
                $q->where('unit_kerja', $unitKerja);
            });
        }

        if ($jenisBarang) {
            $query->whereHas('jenisBarang', function ($q) use ($jenisBarang) {
                $q->where('jenis_barang', $jenisBarang);
            });
        }

        if ($tahun) {
            $query->where('tahun', $tahun);
        }

        $barangs = $query->onlyTrashed()->limit(100)->get();

        if ($this->format === 'pdf') {
            $options = new Options();
            $options->set('isRemoteEnabled', true);
            $pdf = Pdf::loadView('dashboard.admin.barang.pdf_barang_hapus', compact('barangs'))->setPaper('a3', 'landscape');
            return $pdf->download('laporan_barang_dihapus.pdf');
        } elseif ($this->format === 'excel') {
            return Excel::download(new BarangExport($barangs), 'laporan_barang.xlsx');
        }

        return redirect()->back()->with('error', 'Format tidak valid');
    }

    public function exportLogMaintenance(Request $request)
    {
        $bulan = $request->bulan;
        $tahun = $request->tahun;
        $unitKerja = $request->unit_kerja;
        $format = $request->format_export;

        $query = Maintenance::orderBy('created_at', 'desc');

        if ($unitKerja) {
            $query->whereHas('barang.unitKerja', function ($q) use ($unitKerja) {
                $q->where('unit_kerja', $unitKerja);
            });
        }

        if ($bulan) {
            $query->whereMonth('created_at', $bulan);
        }

        if ($tahun) {
            $query->whereYear('created_at', $tahun);
        }

        $maintenances = $query->limit(100)->get();

        if ($format === 'pdf') {
            $options = new Options();
            $options->set('isRemoteEnabled', true);
            $pdf = Pdf::loadView('dashboard.admin.logs.log_maintenance.pdf', compact('maintenances'))->setPaper('a4', 'landscape');
            return $pdf->download('log_maintenance.pdf');
        } elseif ($format === 'excel') {
            return Excel::download(new MaintenanceExport($maintenances), 'log_maintenance.xlsx');
        }

        return redirect()->back()->with('error', 'Format tidak valid');
    }

    public function exportLogBarangTambah(Request $request)
    {
        $bulan = $request->bulan;
        $tahun = $request->tahun;
        $format = $request->format_export;

        $query = DB::table('log_barang_tambah')->orderBy('created_at', 'desc');

        if ($bulan) {
            $query->whereMonth('created_at', $bulan);
        }

        if ($tahun) {
            $query->whereYear('created_at', $tahun);
        }

        return $this->exportService->generateExport($query, 'dashboard.admin.logs.log_barang_tambah.pdf', 'LogBarangTambah', $format);
    }

    public function exportLogBarangDihapus(Request $request)
    {
        $bulan = $request->bulan;
        $tahun = $request->tahun;
        $format = $request->format_export;

        $query = LogBarang::orderBy('created_at', 'desc');

        if ($bulan) {
            $query->whereMonth('created_at', $bulan);
        }

        if ($tahun) {
            $query->whereYear('created_at', $tahun);
        }

        return $this->exportService->generateExport($query, 'dashboard.admin.logs.log_barang_hapus.pdf', 'LogBarangDihapus', $format);
    }

    public function exportLogPersetujuanMaintenance(Request $request)
    {
        $bulan = $request->bulan;
        $tahun = $request->tahun;
        $format = $request->format_export;

        $query = LogPersetujuanMaintenance::orderBy('created_at', 'desc');

        if ($bulan) {
            $query->whereMonth('created_at', $bulan);
        }

        if ($tahun) {
            $query->whereYear('created_at', $tahun);
        }

        return $this->exportService->generateExport($query, 'dashboard.admin.logs.log_persetujuan_maintenance.pdf', 'LogPersetujuanMaintenance', $format);
    }

    public function exportLogKalibrasiBarang(Request $request)
    {
        $bulan = $request->bulan;
        $tahun = $request->tahun;
        $format = $request->format_export;

        $query = DB::table('log_kalibrasi_barang')->orderBy('created_at', 'desc');

        if ($bulan) {
            $query->whereMonth('created_at', $bulan);
        }

        if ($tahun) {
            $query->whereYear('created_at', $tahun);
        }

        return $this->exportService->generateExport($query, 'dashboard.admin.logs.log_kalibrasi_barang.pdf', 'LogKalibrasiBarang', $format);
    }
}
