<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            ['email' => 'aaa@gmail.com', 'password' => bcrypt('aaaaaaaa'), 'role_id' => '1'],
            ['email' => 'bbb@gmail.com', 'password' => bcrypt('aaaaaaaa'), 'role_id' => '1'],
            ['email' => 'ccc@gmail.com', 'password' => bcrypt('aaaaaaaa'), 'role_id' => '1'],
            ['email' => 'ddd@gmail.com', 'password' => bcrypt('aaaaaaaa'), 'role_id' => '1'],
            ['email' => 'eee@gmail.com', 'password' => bcrypt('aaaaaaaa'), 'role_id' => '1']
            //['email' => '@gmail.com', 'password' => bcrypt(''), 'role_id' => '1'],
            //['name' => str_random(10), 'email' => str_random(10).'@gmail.com', 'password' => bcrypt('secret')],
        ]);
    }
}
