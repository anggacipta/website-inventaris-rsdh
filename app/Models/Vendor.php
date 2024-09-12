<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Vendor extends Model
{
    use HasFactory;

    protected $fillable = ['nama_vendor'];

    public static function ensureDefaultCategoryExists()
    {
        if (!DB::table('vendors')->where('id', 1)->exists()) {
            DB::table('vendors')->insert([
                'id' => 1,
                'nama_vendor' => 'Default Kategori'
            ]);
        }
    }

    public function maintenances()
    {
        return $this->hasMany(Maintenance::class, 'vendor_id');
    }
}
