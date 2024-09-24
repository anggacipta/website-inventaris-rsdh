<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class JenisBarang extends Model
{
    use HasFactory;

    protected $fillable = ['jenis_barang', 'kode_barang'];

    public static function ensureDefaultCategoryExists()
    {
        if (!DB::table('jenis_barangs')->where('id', 1)->exists()) {
            DB::table('jenis_barangs')->insert([
                'id' => 1,
                'jenis_barang' => 'Default Kategori'
            ]);
        }
    }

    public function barang()
    {
        return $this->hasMany(Barang::class, 'jenis_barang_id');
    }
}
