<?php

namespace App\Exports;

use App\Models\Barang;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class BarangExport implements FromCollection, WithHeadings
{
    protected $barangs;

    public function __construct($barangs)
    {
        $this->barangs = $barangs;
    }

    public function collection()
    {
        return $this->barangs->map(function ($barang) {
            return [
                'ID' => $barang->id,
                'Nama Barang' => $barang->nama_barang,
                'Kode Barang' => $barang->kode_barang,
                'No Seri' => $barang->no_seri,
                'Distributor' => $barang->distributors->nama_distributor ?? 'Tidak ada distributor resmi',
                'No AKL/AKD' => $barang->no_akl_akd,
                'Tanggal Pengadaan' => $barang->tahun_pengadaan,
                'Tahun Pengadaan' => $barang->tahun,
                'Harga' => $barang->harga,
                'Sumber Pengadaan' => $barang->sumberPengadaan->sumber_pengadaan,
                'Unit Kerja' => $barang->unitKerja->unit_kerja,
                'Jenis Barang' => $barang->jenisBarang->jenis_barang,
                'Merk Barang' => $barang->merkBarang->merk_barang,
                'Kondisi Barang' => $barang->kondisiBarang->kondisi_barang,
                'Keterangan' => $barang->keterangan,
            ];
        });
    }

    public function headings(): array
    {
        return [
            'No', 'Nama Barang', 'Kode Barang', 'No Seri', 'Distributor', 'No AKL/AKD', 'Tanggal Pengadaan', 'Tahun Pengadaan', 'Harga', 'Sumber Pengadaan', 'Unit Kerja', 'Jenis Barang', 'Merk Barang', 'Kondisi Barang', 'Keterangan'
        ];
    }
}
