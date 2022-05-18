<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIsActiveToProductCategories extends Migration
{
    public function up()
    {
        Schema::table('product_categories', function (Blueprint $table) {
            $table->boolean('is_active')->default(1);
        });
    }

    public function down()
    {
        Schema::table('product_categories', function (Blueprint $table) {
          $table->dropColumn(['is_ative']);
        });
    }
}
