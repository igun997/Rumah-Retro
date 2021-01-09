<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToProductMaterialsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('product_materials', function (Blueprint $table) {
            $table->foreign('material_id', 'product_materials_ibfk_1')->references('id')->on('materials')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign('product_id', 'product_materials_ibfk_2')->references('id')->on('products')->onUpdate('CASCADE')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('product_materials', function (Blueprint $table) {
            $table->dropForeign('product_materials_ibfk_1');
            $table->dropForeign('product_materials_ibfk_2');
        });
    }
}
