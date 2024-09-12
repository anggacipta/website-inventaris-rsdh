<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Barang extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    public function ruangan()
    {
        return $this->belongsTo(Ruangan::class, 'ruang_id');
    }

    public function jenisBarang()
    {
        return $this->belongsTo(JenisBarang::class, 'jenis_barang_id');
    }

    public function merkBarang()
    {
        return $this->belongsTo(MerkBarang::class, 'merk_barang_id');
    }

    public function kondisiBarang()
    {
        return $this->belongsTo(KondisiBarang::class, 'kondisi_barang_id');
    }

    public function sumberPengadaan()
    {
        return $this->belongsTo(SumberPengadaan::class, 'sumber_pengadaan_id');
    }

    public function unitKerja()
    {
        return $this->belongsTo(UnitKerja::class, 'unit_kerja_id');
    }

    public function maintenance()
    {
        $this->hasMany(Maintenance::class, 'barang_id');
    }
}
