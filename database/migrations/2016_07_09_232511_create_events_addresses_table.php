<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventsAddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('events_addresses', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('event_id')->unsigned();
            $table->string('line_1');
            $table->string('line_2');
            $table->string('landmark')->nullable();
            $table->integer('zip')->unsigned();
            $table->string('city');
            $table->string('state');
            $table->string('country');
            $table->decimal('latitude', 10, 7);
            $table->decimal('longitude', 10, 7);

            $table->timestamps();
            // indexes
            $table->foreign('event_id')->references('id')->on('events');

            $table->index('zip');
            /*
            $table->index('city');
            $table->index('state');
            $table->index('country');
            */
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('events_addresses');
    }
}
