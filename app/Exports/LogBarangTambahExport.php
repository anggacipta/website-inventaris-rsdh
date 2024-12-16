<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class LogBarangTambahExport implements FromCollection, WithHeadings
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
                'Kode Barang' => $log->kode_barang,
                'Nama Barang' => $log->nama_barang,
                'No Akl Akd' => $log->no_akl_akd,
                'No Seri' => $log->keterangan,
                'Harga' => $log->harga,
                'Tahun Pengadaan' => $log->tahun_pengadaan,
                'Ditambahkan Pada' => \Carbon\Carbon::parse($log->created_at)->setTimezone('Asia/Jakarta')->translatedFormat('d F Y H:i'),
            ];
        });
    }

    public function headings(): array
    {
        return [
            'Kode Barang', 'Nama Barang', 'No Akl Akd', 'No Seri', 'Harga', 'Tahun Pengadaan', 'Ditambahkan Pada'
        ];
    }
}
