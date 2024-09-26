<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Barang;
use App\Models\Maintenance;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Get the current and previous month
        $currentMonth = now()->month;
        $previousMonth = now()->subMonth()->month;

        // Retrieve barang data all
        $totalBarang = Barang::query()->count();

        // Retrieve maintenance data for the current month
        $maintenances = Maintenance::whereMonth('created_at', $currentMonth)->get();
        $total = $maintenances->count();

        $serverCount = $maintenances->where('diperbaiki', 'server')->count();
        $iprsCount = $maintenances->where('diperbaiki', 'ipsrs')->count();
        $vendorCount = $maintenances->where('diperbaiki', 'vendor')->count();

        $serverPercentage = $total ? ($serverCount / $total) * 100 : 0;
        $iprsPercentage = $total ? ($iprsCount / $total) * 100 : 0;
        $vendorPercentage = $total ? ($vendorCount / $total) * 100 : 0;

        // Calculate monthly additions
        $barangByJenis = Barang::selectRaw('jenis_barang_id, COUNT(*) as count')
            ->groupBy('jenis_barang_id')
            ->orderBy('jenis_barang_id')
            ->get()
            ->mapWithKeys(function ($item) {
                return [$item->jenisBarang->jenis_barang => $item->count];
            })
            ->toArray();
        $monthlyAdditionsMaintenance = Maintenance::selectRaw('MONTH(created_at) as month, COUNT(*) as count')
            ->groupBy('month')
            ->orderBy('month')
            ->whereHas('kondisiBarang', function ($query) {
                $query->where('kondisi_barang', '=', 'Maintenance')
                    ->orWhere('kondisi_barang', '=', 'Maintenance Lanjutan');
            })
            ->get()
            ->pluck('count', 'month')
            ->toArray();

        // Fill in missing months with 0
//        $monthlyAdditionsBarang = array_replace(array_fill(1, 12, 0), $monthlyAdditionsBarang);
        $monthlyAdditionsMaintenance = array_replace(array_fill(1, 12, 0), $monthlyAdditionsMaintenance);

        // Calculate current and previous month additions
        $currentMonthMaintenancesDiperbaiki = Maintenance::whereMonth('created_at', $currentMonth)->whereHas('kondisiBarang', function ($query) {
            $query->where('kondisi_barang', '=', 'Berhasil Diperbaiki');
        })->count();
        $currentMonthMaintenances = Maintenance::whereMonth('created_at', $currentMonth)
            ->whereHas('kondisiBarang', function ($query) {
                $query->where('kondisi_barang', '=', 'Maintenance')
                    ->orWhere('kondisi_barang', '=', 'Maintenance Lanjutan');
            })->count();

//        $currentMonthAdditionsBarang = $monthlyAdditionsBarang[$currentMonth] ?? 0;
//        $previousMonthAdditionsBarang = $monthlyAdditionsBarang[$previousMonth] ?? 0;
        $currentMonthAdditionsMaintenance = $monthlyAdditionsMaintenance[$currentMonth] ?? 0;
        $previousMonthAdditionsMaintenance = $monthlyAdditionsMaintenance[$previousMonth] ?? 0;

        // Calculate percentage change
//        $percentageChangeBarang = $previousMonthAdditionsBarang ? (($currentMonthAdditionsBarang - $previousMonthAdditionsBarang) / $previousMonthAdditionsBarang) * 100 : 0;
        $percentageChangeMaintenance = $previousMonthAdditionsMaintenance ? (($currentMonthAdditionsMaintenance - $previousMonthAdditionsMaintenance) / $previousMonthAdditionsMaintenance) * 100 : 0;

        return view('dashboard.admin.index', compact('serverPercentage', 'iprsPercentage', 'vendorPercentage',
            'currentMonthMaintenancesDiperbaiki', 'currentMonthMaintenances', 'percentageChangeMaintenance',
            'monthlyAdditionsMaintenance', 'barangByJenis', 'totalBarang'));
    }
}
