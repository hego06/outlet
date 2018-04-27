<?php

use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(App\ClientesExpo::class, function (Faker $faker) {
    return [
        'folexpo'=> $faker->name, 
        'fechahora'=> $faker->name,
        'hora'=> $faker->name,
        'ftc'=> $faker->name,
        'cnombre'=> $faker->name, 
        'capellidop'=> $faker->name,
        'capellidom'=> $faker->name, 
        'clada'=> $faker->name, 
        'ctelefono'=> $faker->name, 
        'cext'=> $faker->name, 
        'ctipotel'=> $faker->name, 
        'cmail'=> $faker->name, 
        'cid_destin'=> $faker->name, 
        'destino'=> $faker->name, 
        'nid_depto'=> $faker->name,
        'nid_area'=> $faker->name,
        'fsalida'=> $faker->name,
        'numpax'=> $faker->name,
        'observa'=> $faker->name,
        'totpaquete'=> $faker->name,
        'moneda'=> $faker->name, 
        'impteapag'=> $faker->name,
        'monedap'=> $faker->name, 
        'letras'=> $faker->name,  
        'tc'=> $faker->name,
        'cid_emplea'=> $faker->name, 
        'ciniciales'=> $faker->name, 
        'nvendedor'=> $faker->name, 
        'mailejec'=> $faker->name, 
        'status'=> $faker->name, 
        'motivocanc'=> $faker->name,  
        'quiencancela'=> $faker->name, 
        'cid_cotiza'=> $faker->name, 
        'cid_expedi'=> $faker->name, 
        'baja'=> $faker->name,
        'tproceso'=> $faker->name,
        'fecha'=> $faker->name,
        'aplic'=> $faker->name,
        'archivo'=> $faker->name,
        'lamm'=> $faker->name,
    ];
});
