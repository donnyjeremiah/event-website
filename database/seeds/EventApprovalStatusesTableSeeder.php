<?php

use Illuminate\Database\Seeder;

class EventApprovalStatusesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('event_approval_statuses')->insert([
           ['name' => 'Pending'],
           ['name' => 'Approved'],
           ['name' => 'Declined']
        ]);
    }
}
