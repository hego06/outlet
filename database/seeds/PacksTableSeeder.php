<?php

use Illuminate\Database\Seeder;

class PacksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $packs = array(
            ['name'=>'Noruega','mt'=>'MT1'],
            ['name'=>'Canada','mt'=>'MT2'],
            ['name'=>'Islandia','mt'=>'MT3'],
            ['name'=>'Indonesia','mt'=>'MT4'],
            ['name'=>'Japon','mt'=>'MT5'],
        );

        foreach($packs as $packs)
        {
            DB::table('packs')->insert([
                'name'=> $packs['name'],
                'mt'=> $packs['mt']
            ]);
        }
    }
}
