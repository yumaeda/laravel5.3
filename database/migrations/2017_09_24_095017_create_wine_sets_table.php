<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWineSetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wine_sets', function(Blueprint $table)
        {
            $table->increments('id');
            $table->string('name', 500);
            $table->longText('comment');
            $table->tinyInteger('type')->unsigned()->default(0);
            $table->double('discount_rate', 12, 8)->unsigned();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('wine_sets');
    }
}
