<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSkusTable extends Migration
{
    public function up()
    {
        Schema::create('skus', function (Blueprint $table) {
            $table->id();
            // $table->foreignId('industry_id')->constrained('industries');
            $table->string('name');
            // $table->string('capacity')->nullable();
            $table->string('measurement')->nullable();
            $table->softDeletes('deleted_at', 0);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('skus');
    }
}
