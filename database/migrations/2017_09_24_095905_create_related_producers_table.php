<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRelatedProducersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('related_producers', function(Blueprint $table)
        {
            $table->increments('id');
            $table->string('parent', 300);
            $table->string('name', 300);
            $table->string('name_jpn', 900);
            $table->string('description', 300);
        });
        //
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('related_producers');
    }
}
