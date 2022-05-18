<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompanySelectionCountsTable extends Migration
{
    
    public function up()
    {
        Schema::create('company_selection_counts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('visitor_id')->constrained('visitors');
            $table->foreignId('company_id')->constrained('companies');
            $table->date('date');
            $table->softDeletes('deleted_at', 0);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('company_selection_counts');
    }
}
