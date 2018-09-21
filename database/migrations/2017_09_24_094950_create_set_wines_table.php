<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSetWinesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('set_wines', function(Blueprint $table)
        {
            $table->increments('id');
            $table->integer('set_id')->unsigned()->default(0);
            $table->char('barcode_number', 4);
            $table->mediumText('comment');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('set_wines');
    }
}
