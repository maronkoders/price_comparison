<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddManufacturerReportEnabledToProductAttributes extends Migration
{
    public function up()
    {
        Schema::table('product_attributes', function (Blueprint $table) {
            $table->boolean('manufacturer_report_enabled')->default(1);
        });
    }

    public function down()
    {
        Schema::table('product_attributes', function (Blueprint $table) {
            $table->dropColumn(['manufacturer_report_enabled']);
        });
    }
}
