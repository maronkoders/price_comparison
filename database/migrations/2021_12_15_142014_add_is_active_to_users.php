<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIsActiveToUsers extends Migration
{
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->boolean('is_active')->default(0);
        });
    }

    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
           $table->dropColumn(['is_active']);
        });
    }
}
