<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateShippingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shippings', function(Blueprint $table)
        {
            $table->increments('id');
            $table->string('email', 80);
            $table->string('name', 100);
            $table->string('phonetic', 100);
            $table->char('post_code', 8);
            $table->string('prefecture', 10);
            $table->string('address', 300);
            $table->string('phone', 13);
            $table->string('delivery_company', 30);
            $table->string('delivery_date', 30);
            $table->string('delivery_time', 30);
            $table->boolean('refrigerated')->default(1);
            $table->string('comment', 2000);
            $table->integer('fee')->unsigned();
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
        Schema::dropIfExists('shippings');
    }
}
