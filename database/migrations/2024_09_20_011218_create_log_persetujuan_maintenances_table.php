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
        Schema::create('log_persetujuan_maintenances', function (Blueprint $table) {
            $table->id();
            $table->string('id_barang');
            $table->string('nama_barang');
            $table->string('unit_kerja');
            $table->boolean('persetujuan_staff_ahli');
            $table->boolean('persetujuan_direktur');
            $table->text('catatan_staff')->nullable();
            $table->text('catatan_direktur')->nullable();
            $table->date('tanggal_maintenance');
            $table->date('tanggal_maintenance_lanjutan');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('log_persetujuan_maintenances');
    }
};
