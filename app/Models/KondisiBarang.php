<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class KondisiBarang extends Model
{
    use HasFactory;

    protected $fillable = ['kondisi_barang'];

    public static function ensureDefaultCategoryExists()
    {
        if (!DB::table('kondisi_barangs')->where('id', 1)->exists()) {
            DB::table('kondisi_barangs')->insert([
                'id' => 1,
                'kondisi_barang' => 'Default Kategori'
            ]);
        }
    }

    public function barang()
    {
        return $this->hasMany(Barang::class, 'kondisi_barang_id');
    }

    public function maintenance()
    {
        return $this->hasMany(Maintenance::class, 'kondisi_barang_id');
    }
}
