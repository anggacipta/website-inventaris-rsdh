<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Maintenance extends Model
{
    use HasFactory;

    protected $fillable = [
        'alasan_rusak',
        'catatan',
        'harga',
        'diperbaiki',
        'disetujui',
        'kondisi_barang_id',
        'barang_id',
        'vendor_id'
    ];

    public function barang()
    {
        // Get data with soft delete
        return $this->belongsTo(Barang::class, 'barang_id')->withTrashed();
    }

    public function kondisiBarang()
    {
        return $this->belongsTo(KondisiBarang::class, 'kondisi_barang_id');
    }

    public function vendor()
    {
        return $this->belongsTo(Vendor::class, 'vendor_id');
    }
}
