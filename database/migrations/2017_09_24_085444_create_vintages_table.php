<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVintagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vintages', function(Blueprint $table)
        {
            $table->increments('id');
            $table->string('country', 30);
            $table->string('region', 250);
            $table->string('region_jpn', 750);
            $table->string('district', 250)->nullable();
            $table->string('district_jpn', 750)->nullable();
            $table->smallInteger('vintage')->unsigned();
            $table->longText('contents')->nullable();
            $table->string('reference', 1000);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vintages');
    }
}
