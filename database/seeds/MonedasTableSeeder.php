<?php

use Illuminate\Database\Seeder;

class MonedasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $monedas = array('PESOS - MXN','DÓLARES - UDS');
        foreach($monedas as $moneda)
        {
            DB::table('monedas')->insert([
                'name' =>$moneda,
            ]);
        }
    }
}
