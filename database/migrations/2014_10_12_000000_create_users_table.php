<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table)
        {
            $table->increments('id');
            $table->string('last_name', 50);
            $table->string('first_name', 50);
            $table->string('last_name_phonetic', 50);
            $table->string('first_name_phonetic', 50);
            $table->string('date_of_birth', 50);
            $table->char('post_code', 8);
            $table->string('prefecture', 10);
            $table->string('address', 300);
            $table->string('phone', 13);
            $table->string('email')->unique();
            $table->string('password');
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
