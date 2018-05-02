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
            ['Norberto Hernandez','NHG','norberto@examle.com'],
            ['Laura Hernandez','LHG','laura@examle.com'],
            ['admin','AAA','admin@example.com']
        );

        foreach($users as $user)
        {
            DB::table('users')->insert([
                'nvendedor' => $user[0],
                'ciniciales' => $user[1],
                'email' => $user[2],
                'password' => bcrypt('123')
            ]);
        }
    }
}
