<?php

namespace App\Exports;

use App\Models\LogBarang;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class LogBarangDihapusExport implements FromCollection, WithHeadings
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
                'Alasan Dihapus' => $log->keterangan,
                'Dihapus Pada' => \Carbon\Carbon::parse($log->created_at)->setTimezone('Asia/Jakarta')->translatedFormat('d F Y H:i'),
            ];
        });
    }

    public function headings(): array
    {
        return [
            'Kode Barang', 'Nama Barang', 'Unit Kerja', 'Alasan Dihapus', 'Dihapus Pada'
        ];
    }
}
