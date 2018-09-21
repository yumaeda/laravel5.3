<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProducersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('producers', function(Blueprint $table)
        {
            $table->increments('id');
            $table->string('name', 300);
            $table->string('name_jpn', 900);
            $table->string('short_name', 300);
            $table->string('short_name_jpn', 900);
            $table->string('country', 30);
            $table->string('region', 250);
            $table->string('region_jpn', 750);
            $table->string('district', 250)->nullable();
            $table->string('district_jpn', 750)->nullable();
            $table->string('village', 250)->nullable();
            $table->string('village_jpn', 750)->nullable();
            $table->string('home_page', 1000)->nullable();
            $table->string('founded_year', 200)->nullable();
            $table->string('headquarter', 250)->nullable();
            $table->string('headquarter_jpn', 750)->nullable();
            $table->string('family_head', 300)->nullable();
            $table->string('family_head_jpn', 1000)->nullable();
            $table->string('field_area', 200)->nullable();
            $table->string('importer', 300)->nullable();
            $table->longText('history_detail')->nullable();
            $table->longText('field_detail')->nullable();
            $table->longText('fermentation_detail')->nullable();
            $table->longText('original_contents')->nullable();
            $table->boolean('is_original')->default(0);
            $table->boolean('is_multi')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('producers');
    }
}
