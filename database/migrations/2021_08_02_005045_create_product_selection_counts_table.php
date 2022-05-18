<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductSelectionCountsTable extends Migration
{
  
    public function up()
    {
        Schema::create('product_selection_counts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('visitor_id')->constrained('visitors');
            $table->foreignId('product_attribute_id')->constrained('product_attributes');
            $table->date('date');
            $table->softDeletes('deleted_at', 0);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('product_selection_counts');
    }
}
