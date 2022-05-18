<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRepresentativeOptionToCompanyRepresentatives extends Migration
{
    public function up()
    {
        Schema::table('company_representatives', function (Blueprint $table) {
            $table->string('representative_option');
        });
    }

    public function down()
    {
        Schema::table('company_representatives', function (Blueprint $table) {
            $table->dropColumn(['representative_option']);
        });
    }
}
