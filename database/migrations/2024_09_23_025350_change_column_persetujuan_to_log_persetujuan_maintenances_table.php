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
            $table->boolean('persetujuan_staff_ahli')->nullable()->change();
            $table->boolean('persetujuan_direktur')->nullable()->change();
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
            $table->boolean('persetujuan_staff_ahli')->change();
            $table->boolean('persetujuan_direktur')->change();
        });
    }
};
