<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\User;
use App\Receta;
use App\Categoria;
use Carbon\Carbon;
use Faker\Generator as Faker;

$factory->define(Receta::class, function (Faker $faker) {
    //crear un numero aleatorio para la foto
    $numero = rand(1,26);

    return [
        'user_id' => User::all()->random()->id,
        'categoria_id' => Categoria::all()->random()->id,
        'titulo' => $faker->sentence,
        'ingredientes' => $faker->text(1000),
        'preparacion' => $faker->text(1000),
        'imagen' => $faker->randomElement(['recetas/food'.$numero.'.jpg']),
        'created_at' => $faker->dateTimeBetween('-1 years', Carbon::now())
    ];
});
