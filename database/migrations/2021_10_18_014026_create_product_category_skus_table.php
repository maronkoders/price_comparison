<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductCategorySkusTable extends Migration
{
    public function up()
    {
        Schema::create('product_category_skus', function (Blueprint $table) {
            $table->id();
            $table->foreignId('sku_id')->constrained('skus');
            $table->foreignId('product_category_id')->constrained('product_categories');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('product_category_skus');
    }
}
