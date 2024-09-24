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
            $table->text('keterangan')->nullable()->change();
            $table->string('distributor')->nullable()->change();
            $table->string('no_akl_akd')->nullable()->change();
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
            $table->text('keterangan')->change();
            $table->string('distributor')->change();
            $table->string('no_akl_akd')->change();
        });
    }
};
