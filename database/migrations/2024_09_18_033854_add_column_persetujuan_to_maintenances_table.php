<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('maintenances', function (Blueprint $table) {
            $table->boolean('persetujuan_staff_ahli')->nullable()->after('barang_id');
            $table->boolean('persetujuan_direktur')->nullable()->after('persetujuan_staff_ahli');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('maintenances', function (Blueprint $table) {
            $table->dropColumn('persetujuan_staff_ahli');
            $table->dropColumn('persetujuan_direktur');
        });
    }
};
