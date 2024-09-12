<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class SumberPengadaan extends Model
{
    use HasFactory;

    protected $fillable = ['sumber_pengadaan'];

    public static function ensureDefaultCategoryExists()
    {
        if (!DB::table('sumber_pengadaans')->where('id', 1)->exists()) {
            DB::table('sumber_pengadaans')->insert([
                'id' => 1,
                'sumber_pengadaan' => 'Default Kategori'
            ]);
        }
    }
    public function barang()
    {
        return $this->hasMany(Barang::class, 'sumber_pengadaan_id');
    }
}
