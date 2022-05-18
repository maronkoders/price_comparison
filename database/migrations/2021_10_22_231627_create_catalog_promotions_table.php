<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCatalogPromotionsTable extends Migration
{
    public function up()
    {
        Schema::create('catalog_promotions', function (Blueprint $table) 
        {
            $table->id();
            $table->text('promotion_text');
            $table->integer('period')->nullable();
            $table->date('end_date')->nullable();
            $table->date('start_date')->nullable();
            $table->foreignId('company_id')->constrained('companies');
            $table->boolean('is_active');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('catalog_promotions');
    }
}
