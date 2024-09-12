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
            // Drop the existing foreign key constraint
            $table->dropForeign(['kondisi_barang_id']);
            $table->dropForeign(['barang_id']);
            $table->dropForeign(['vendor_id']);

            // Add the new foreign key constraint with onDelete('cascade')
            $table->foreign('kondisi_barang_id')
                ->references('id')
                ->on('kondisi_barangs')
                ->onDelete('cascade');

            $table->foreign('barang_id')
                ->references('id')
                ->on('barangs')
                ->onDelete('cascade');

            $table->foreign('vendor_id')
                ->references('id')
                ->on('vendors')
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
        Schema::table('maintenances', function (Blueprint $table) {
            // Drop the new foreign key constraint
            $table->dropForeign(['kondisi_barang_id']);
            $table->dropForeign(['barang_id']);
            $table->dropForeign(['vendor_id']);

            // Re-add the original foreign key constraint
            $table->foreign('kondisi_barang_id')
                ->references('id')
                ->on('kondisi_barangs');

            $table->foreign('barang_id')
                ->references('id')
                ->on('barangs');

            $table->foreign('vendor_id')
                ->references('id')
                ->on('vendors');
        });
    }
};
