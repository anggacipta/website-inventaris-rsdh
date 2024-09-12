<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class MerkBarang extends Model
{
    use HasFactory;

    protected $fillable = ['merk_barang'];

    public static function ensureDefaultCategoryExists()
    {
        if (!DB::table('merk_barangs')->where('id', 1)->exists()) {
            DB::table('merk_barangs')->insert([
                'id' => 1,
                'merk_barang' => 'Default Kategori'
            ]);
        }
    }

    public function barang()
    {
        return $this->hasMany(Barang::class, 'merk_barang_id');
    }
}
