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
        $users = array(
            ['Norberto Hernandez','norberto@examle.com'],
            ['Laura Hernandez','laura@examle.com'],
            ['admin','admin@example.com']
        );

        foreach($users as $user)
        {
            DB::table('users')->insert([
                'name' => $user[0],
                'email' => $user[1],
                'password' => bcrypt('123')
            ]);
        }
    }
}
