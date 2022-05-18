<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string("name");
            $table->string("phone")->unique()->nullable();
            $table->string("email")->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->enum('gender',['male','female'])->nullable();
            $table->date('dob')->nullable();
            $table->string('password');
            $table->text('slug')->nullable();
            $table->foreignId('user_role_id')->constrained('user_roles');
            $table->softDeletes('deleted_at', 0);
            $table->rememberToken();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('users');
    }
}
