<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UserRolesTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(OrganisersTableSeeder::class);

        $this->call(EventTypesTableSeeder::class);
        $this->call(EventApprovalStatusesTableSeeder::class);
    }
}