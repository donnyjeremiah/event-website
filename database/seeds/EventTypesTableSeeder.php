<?php

use Illuminate\Database\Seeder;

class EventTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('event_types')->insert([
           ['name' => 'Art-Festival'],
           ['name' => 'Film-Festival'],
           ['name' => 'Debate'],
           ['name' => 'Party'],
           ['name' => 'Talk']
        ]);
    }
}
