<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\DB;

class Distributor extends Model
{
    use HasFactory;

    protected $fillable = ['nama_distributor'];

    public static function ensureDefaultCategoryExists()
    {
        if (!DB::table('distributors')->where('id', 1)->exists()) {
            DB::table('distributors')->insert([
                'id' => 1,
                'nama_distributor' => 'Default Kategori'
            ]);
        }
    }

    public function barang(): HasMany
    {
        return $this->hasMany(Barang::class, 'distributor_id');
    }
}
