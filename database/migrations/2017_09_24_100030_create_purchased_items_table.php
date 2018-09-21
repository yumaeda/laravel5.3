<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePurchasedItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchased_items', function(Blueprint $table)
        {
            $table->increments('id');
            $table->string('order_id', 30);
            $table->string('customer_id', 80);
            $table->char('barcode_number', 4)->default('0000');
            $table->smallInteger('quantity')->unsigned();
            $table->timestamp('purchased')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('purchased_items');
    }
}
