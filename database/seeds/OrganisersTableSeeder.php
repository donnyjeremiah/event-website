<?php

use Illuminate\Database\Seeder;

class OrganisersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('organisers')->insert([
            ['user_id' => '1', 'name' => 'Aguero', 'mobile' => '9789845987'],
            ['user_id' => '2', 'name' => 'Bacary', 'mobile' => '9888837659']
        ]);
    }
}
