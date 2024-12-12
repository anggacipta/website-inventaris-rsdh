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
        Schema::create('log_kalibrasi_barang', function (Blueprint $table) {
            $table->id();
            $table->string('nama_barang')->nullable();
            $table->string('unit_kerja')->nullable();
            $table->string('kode_barang')->nullable();
            $table->date('tanggal_kalibrasi')->nullable();
            $table->string('no_sertifikat')->nullable();
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
        Schema::dropIfExists('log_kalibrasi_barang');
    }
};
