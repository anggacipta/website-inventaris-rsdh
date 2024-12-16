<?php

namespace App\Exports;

use App\Models\Maintenance;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class MaintenanceExport implements FromCollection, WithHeadings
{
    protected $maintenances;

    public function __construct($maintenances)
    {
        $this->maintenances = $maintenances;
    }

    public function collection()
    {
        return $this->maintenances->map(function ($maint) {
            return [
                'Kode Barang' => $maint->barang->kode_barang,
                'Nama Barang' => $maint->barang->nama_barang,
                'Unit Kerja' => $maint->barang->unitKerja->unit_kerja,
                'Jenis Barang' => $maint->barang->jenisBarang->jenis_barang,
                'Alasan Rusak' => $maint->alasan_rusak,
                'Kondisi Barang' => $maint->kondisi_barang,
                'Tanggal Pengajuan' => \Carbon\Carbon::parse($maint->created_at)->timezone('Asia/Jakarta')->format('d M Y H:i'),
                'Tanggal Pengajuan Vendor' => \Carbon\Carbon::parse($maint->tanggal_maintenance_lanjutan)->timezone('Asia/Jakarta')->format('d M Y H:i'),
            ];
        });
    }

    public function headings(): array
    {
        return [
            'Kode Barang', 'Nama Barang', 'Unit Kerja', 'Jenis Barang', 'Alasan Rusak', 'Kondisi Barang', 'Tanggal Pengajuan', 'Tanggal Pengajuan Vendor'
        ];
    }
}
