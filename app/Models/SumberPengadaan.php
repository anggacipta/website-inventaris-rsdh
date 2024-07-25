<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SumberPengadaan extends Model
{
    use HasFactory;

    protected $fillable = ['sumber_pengadaan'];

    public function barang()
    {
        return $this->hasMany(Barang::class, 'sumber_pengadaan_id');
    }
}
