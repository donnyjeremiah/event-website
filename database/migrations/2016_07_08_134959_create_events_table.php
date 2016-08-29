<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {
            $table->increments('id'); // primary, note: or bigIncrements()?
            $table->integer('user_id')->unsigned(); // organisers
            $table->string('name');
            $table->date('date_start');
            $table->date('date_end')->nullable();
            $table->time('time');
            $table->text('description');
            $table->integer('poster_no');
            $table->integer('type_id')->unsigned();
            $table->integer('status_id')->unsigned(); // pending, approved, declined, stalled

            // CONTACT and FEE
            //$table->string('contact_name',50);
            //$table->string('contact_email',50);
            //$table->string('contact_mobile',15);
            //$table->boolean('is_free');
            //$table->integer('fee')->nullable();

            $table->timestamps();
            // indexes
            $table->foreign('user_id')->references('user_id')->on('organisers');
            $table->foreign('type_id')->references('id')->on('event_types');
            $table->foreign('status_id')->references('id')->on('event_approval_statuses');

            $table->index('name');
            $table->index('type_id');
            $table->index('status_id');
            $table->index('date_start');
            //$table->index('fee');
        });

        DB::statement('ALTER TABLE events ADD FULLTEXT events_description_fulltext(description)');

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('events');
    }
}
