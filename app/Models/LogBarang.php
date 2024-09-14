<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LogBarang extends Model
{
    use HasFactory;

    protected $fillable = [
      'id_barang',
      'nama_barang',
      'unit_kerja',
      'keterangan'
    ];
}
