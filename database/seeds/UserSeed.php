<?php

use Illuminate\Database\Seeder;

class UserSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
        	'name'=>'Admin',
        	'email'=>'admin@gmail.com',
        	'password'=>bcrypt('admin'),
        	'user_type'=>0,
        ]);
    }
}
