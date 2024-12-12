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
        Schema::create('log_barang_tambah', function (Blueprint $table) {
            $table->id();
            $table->string('nama_barang')->nullable();
            $table->string('no_akl_akd')->nullable();
            $table->string('tahun_pengadaan')->nullable();
            $table->integer('harga')->nullable();
            $table->string('keterangan')->nullable();
            $table->string('kode_barang')->nullable();
            $table->string('no_seri')->nullable();
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
        Schema::dropIfExists('log_barang_tambah');
    }
};
