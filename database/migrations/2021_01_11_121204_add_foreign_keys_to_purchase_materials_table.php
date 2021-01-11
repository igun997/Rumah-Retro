<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToPurchaseMaterialsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('purchase_materials', function (Blueprint $table) {
            $table->foreign('purchase_id', 'purchase_materials_ibfk_2')->references('id')->on('purchases')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign('material_id', 'purchase_materials_ibfk_3')->references('id')->on('materials')->onUpdate('CASCADE')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('purchase_materials', function (Blueprint $table) {
            $table->dropForeign('purchase_materials_ibfk_2');
            $table->dropForeign('purchase_materials_ibfk_3');
        });
    }
}
