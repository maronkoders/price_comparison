<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSiteLinkToCompanies extends Migration
{
    public function up()
    {
        Schema::table('companies', function (Blueprint $table) {
           $table->text('site_link');
        });
    }

    public function down()
    {
        Schema::table('companies', function (Blueprint $table) {
            $table->dropColumn(['site_link']);
        });
    }
}
