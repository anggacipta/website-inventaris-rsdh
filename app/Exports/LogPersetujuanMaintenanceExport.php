<?php

namespace App\Exports;

use App\Models\LogPersetujuanMaintenance;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class LogPersetujuanMaintenanceExport implements FromCollection, WithHeadings
{
    protected $logs;

    public function __construct($logs)
    {
        $this->logs = $logs;
    }

    public function collection()
    {
        return $this->logs->map(function ($log) {
            return [
                'Kode Barang' => $log->id_barang,
                'Nama Barang' => $log->nama_barang,
                'Unit Kerja' => $log->unit_kerja,
                'Persetujuan Staff Ahli' => $log->persetujuan_staff_ahli === null ? 'Menunggu Persetujuan' : ($log->persetujuan_staff_ahli ? 'Disetujui' : 'Ditolak'),
                'Persetujuan Direktur' => $log->persetujuan_direktur === null ? 'Menunggu Persetujuan' : ($log->persetujuan_direktur ? 'Disetujui' : 'Ditolak'),
                'Dibuat Pada' => \Carbon\Carbon::parse($log->created_at)->setTimezone('Asia/Jakarta')->translatedFormat('d F Y H:i'),
            ];
        });
    }

    public function headings(): array
    {
        return [
            'Kode Barang', 'Nama Barang', 'Unit Kerja', 'Persetujuan Staff Ahli', 'Persetujuan Direktur', 'Dibuat Pada'
        ];
    }
}
