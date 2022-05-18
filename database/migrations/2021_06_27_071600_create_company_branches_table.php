<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompanyBranchesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('company_branches', function (Blueprint $table) {
            $table->id();
            $table->string("name");
            $table->string("latitude")->nullable();
            $table->string("longitude")->nullable();
            $table->string("telephone")->nullable();
            $table->string("website")->nullable();
            $table->text('slug')->nullable();
            $table->string("address");
            $table->foreignId('company_id')->constrained('companies');
            $table->foreignId('zone_id')->constrained('zones');
            $table->softDeletes('deleted_at', 0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('company_branches');
    }
}
