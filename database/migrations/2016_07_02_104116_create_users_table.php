<?php

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
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('email'); // max size: 255
            $table->string('password'); // when password hashed it becomes 60 characters
            $table->integer('role_id')->unsigned();

            //$table->rememberToken(); // matches a cookie you have to a hash value in a databease table
            $table->timestamps();
            // indexes
            $table->foreign('role_id')->references('id')->on('user_roles'); // ->onDelete('cascade');
            $table->unique('email');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('users');
    }
}
