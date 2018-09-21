<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHtmlPagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('html_pages', function(Blueprint $table)
        {
            $table->increments('id');
            $table->string('country', 30);
            $table->string('region', 250);
            $table->string('district', 250);
            $table->string('village', 250);
            $table->mediumText('contents');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('html_pages');
    }
}
