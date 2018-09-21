<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWinesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wines', function(Blueprint $table)
        {
            $table->increments('id');
            $table->string('barcode_number', 6);
            $table->integer('price')->unsigned();
            $table->integer('member_price')->unsigned();
            $table->string('cepage', 1000);
            $table->string('rating', 250)->nullable();
            $table->string('rating_jpn', 750)->nullable();
            $table->string('cultivation_method', 30)->nullable();
            $table->integer('stock')->unsigned();
            $table->string('importer', 300)->nullable();
            $table->string('type', 30)->nullable();
            $table->string('country', 30)->nullable();
            $table->string('producer', 300)->nullable();
            $table->string('producer_jpn', 1000)->nullable();
            $table->string('vintage', 50)->nullable();
            $table->string('village', 500)->nullable();
            $table->string('village_jpn', 1500)->nullable();
            $table->string('district', 500)->nullable();
            $table->string('district_jpn', 1500)->nullable();
            $table->string('region', 500)->nullable();
            $table->string('region_jpn', 1500)->nullable();
            $table->string('apply', 50)->nullable();
            $table->string('avilability', 50)->nullable();
            $table->string('etc', 50)->nullable();
            $table->string('comment', 2000)->nullable();
            $table->string('name', 300);
            $table->string('name_jpn', 1000)->nullable();
            $table->string('point', 2000)->nullable();
            $table->string('catch_copy', 1000)->nullable();
            $table->string('combined_name', 1000);
            $table->string('combined_name_jpn', 3000);
            $table->integer('capacity')->unsigned();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('wines');
    }
}
