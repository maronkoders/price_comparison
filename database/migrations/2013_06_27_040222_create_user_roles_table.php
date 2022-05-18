<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserRolesTable extends Migration
{
   
    public function up()
    {
        Schema::create('user_roles', function (Blueprint $table) {
            $table->id();
            $table->string("name")->unique();
            $table->text('slug');
            $table->softDeletes('deleted_at', 0);
            $table->timestamps();
        });
    }

  
    public function down()
    {
        Schema::dropIfExists('user_roles');
    }
}
