<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function(Blueprint $table)
        {
            $table->string('order_id', 30)->primary();
            $table->string('customer_name', 100);
            $table->string('customer_phonetic', 100);
            $table->string('customer_email', 80);
            $table->string('customer_address', 500);
            $table->string('customer_phone', 13);
            $table->integer('shipping_id')->unsigned();
            $table->char('transaction_id', 14);
            $table->string('contents', 1000);
            $table->tinyInteger('status')->unsigned();
            $table->tinyInteger('payment_method')->unsigned(); /* 0:TBD, 1:Credit Card, 2:Bank Transfer */
            $table->tinyInteger('member_discount')->unsigned()->default(0);
            $table->integer('wine_total')->unsigned();
            $table->string('ip_address1', 50)->default('0.0.0.0');
            $table->string('ip_address2', 50)->default('0.0.0.0');
            $table->string('user_agent', 500);
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
        Schema::dropIfExists('orders');
    }
}
