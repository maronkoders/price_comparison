<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSkuIdToProductAttributes extends Migration
{
    public function up()
    {
        Schema::table('product_attributes', function (Blueprint $table) {
            $table->integer('sku_id');
        });
    }

    public function down()
    {
        Schema::table('product_attributes', function (Blueprint $table) {
            $table->dropColumn(['sku_id']);
        });
    }
}
