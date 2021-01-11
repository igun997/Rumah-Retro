<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToProductionMaterialsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('production_materials', function (Blueprint $table) {
            $table->foreign('production_id', 'production_materials_ibfk_2')->references('id')->on('productions')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign('product_id', 'production_materials_ibfk_3')->references('id')->on('products')->onUpdate('CASCADE')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('production_materials', function (Blueprint $table) {
            $table->dropForeign('production_materials_ibfk_2');
            $table->dropForeign('production_materials_ibfk_3');
        });
    }
}
