<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToIndonesiaDistrictsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('indonesia_districts', function (Blueprint $table) {
            $table->foreign('city_id')->references('id')->on('indonesia_cities')->onUpdate('CASCADE')->onDelete('RESTRICT');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('indonesia_districts', function (Blueprint $table) {
            $table->dropForeign('indonesia_districts_city_id_foreign');
        });
    }
}
