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
        Schema::table('log_persetujuan_maintenances', function (Blueprint $table) {
            $table->integer('harga_vendor')->nullable()->after('catatan_direktur');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('log_persetujuan_maintenances', function (Blueprint $table) {
            $table->dropColumn('harga_vendor');
        });
    }
};
