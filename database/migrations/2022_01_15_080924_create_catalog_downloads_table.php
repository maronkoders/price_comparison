<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCatalogDownloadsTable extends Migration
{
    public function up()
    {
        Schema::create('catalog_downloads', function (Blueprint $table) {
            $table->id();
            $table->foreignId('subscriber_id')->constrained('news_letter_subscribers');
            $table->text('platform');
            $table->text('platformVersion');
            $table->text('browser');
            $table->string('city');
            $table->string('device');
            $table->string('deviceType');
            $table->string('country');
            $table->timestamps();
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('catalog_downloads');
    }
}
