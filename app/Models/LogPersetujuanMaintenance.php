<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LogPersetujuanMaintenance extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_barang',
        'nama_barang',
        'unit_kerja',
        'persetujuan_staff_ahli',
        'persetujuan_direktur',
        'catatan_staff',
        'catatan_direktur',
        'tanggal_maintenance',
        'tanggal_maintenance_lanjutan',
        'harga_vendor'
    ];
}
