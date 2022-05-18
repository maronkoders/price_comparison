<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHeaderPromotionsTable extends Migration
{
    public function up()
    {
        Schema::create('header_promotions', function (Blueprint $table) {
            $table->id();
            $table->text('path');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('header_promotions');
    }
}
