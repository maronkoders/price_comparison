<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBannerSlidesTable extends Migration
{
   
    public function up()
    {
        Schema::create('banner_slides', function (Blueprint $table) {
            $table->id();
            $table->string('show_time');
            $table->text('slug')->nullable();
            $table->foreignId('company_branch_banner_id')->constrained('company_branch_banners');
            $table->softDeletes('deleted_at', 0);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('banner_slides');
    }
}
