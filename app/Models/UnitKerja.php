<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class UnitKerja extends Model
{
    use HasFactory;

    protected $fillable = ['unit_kerja', 'kode_barang'];

    public static function ensureDefaultCategoryExists()
    {
        if (!DB::table('unit_kerjas')->where('id', 1)->exists()) {
            DB::table('unit_kerjas')->insert([
                'id' => 1,
                'unit_kerja' => 'Default Kategori'
            ]);
        }
    }

    public function barang()
    {
        return $this->hasMany(Barang::class, 'unit_kerja_id');
    }

    public function users()
    {
        return $this->hasMany(User::class, 'unit_kerja_id');
    }
}
