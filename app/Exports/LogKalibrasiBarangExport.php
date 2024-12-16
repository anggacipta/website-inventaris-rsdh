<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class LogKalibrasiBarangExport implements FromCollection, WithHeadings
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
                $log->kode_barang,
                $log->nama_barang,
                $log->unit_kerja,
                $log->tanggal_kalibrasi,
                $log->no_sertifikat,
                $log->created_at,
            ];
        });
    }

    public function headings(): array
    {
        return [
            'Kode Barang', 'Nama Barang', 'Unit Kerja', 'Tanggal Kalibrasi', 'No Sertifikat', 'Ditambahkan Pada'
        ];
    }
}
