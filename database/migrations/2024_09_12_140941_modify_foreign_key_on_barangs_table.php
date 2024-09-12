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
        Schema::table('barangs', function (Blueprint $table) {
            $table->dropForeign(['kondisi_barang_id']);
            $table->dropForeign(['jenis_barang_id']);
            $table->dropForeign(['merk_barang_id']);
            $table->dropForeign(['sumber_pengadaan_id']);
            $table->dropForeign(['unit_kerja_id']);

            $table->foreign('kondisi_barang_id')
                ->references('id')
                ->on('kondisi_barangs')
                ->onDelete('cascade');

            $table->foreign('jenis_barang_id')
                ->references('id')
                ->on('jenis_barangs')
                ->onDelete('cascade');

            $table->foreign('merk_barang_id')
                ->references('id')
                ->on('merk_barangs')
                ->onDelete('cascade');

            $table->foreign('sumber_pengadaan_id')
                ->references('id')
                ->on('sumber_pengadaans')
                ->onDelete('cascade');

            $table->foreign('unit_kerja_id')
                ->references('id')
                ->on('unit_kerjas')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('barangs', function (Blueprint $table) {
            $table->dropForeign(['kondisi_barang_id']);
            $table->dropForeign(['jenis_barang_id']);
            $table->dropForeign(['merk_barang_id']);
            $table->dropForeign(['sumber_pengadaan_id']);
            $table->dropForeign(['unit_kerja_id']);

            $table->foreign('kondisi_barang_id')
                ->references('id')
                ->on('kondisi_barangs');

            $table->foreign('jenis_barang_id')
                ->references('id')
                ->on('jenis_barangs');

            $table->foreign('merk_barang_id')
                ->references('id')
                ->on('merk_barangs');

            $table->foreign('sumber_pengadaan_id')
                ->references('id')
                ->on('sumber_pengadaans');

            $table->foreign('unit_kerja_id')
                ->references('id')
                ->on('unit_kerjas');
        });
    }
};
