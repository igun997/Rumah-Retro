<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePurchaseMaterialsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchase_materials', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('purchase_id')->index('purchase_id');
            $table->integer('material_id')->index('product_id');
            $table->float('qty', 10, 0);
            $table->float('price', 10, 0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('purchase_materials');
    }
}
