<?php

use Faker\Generator as Faker;
 
/* Factory para Roles */
$factory->define(App\Role::class, function (Faker $faker) {
    return [
        'label' => $faker->sentence($nbWords = 3, $variableNbWords = true)
    ];
});

/* Factory para Informações */
$factory->define(App\Info::class, function (Faker $faker) {
    return [
        'scriptshead' => '<script></script>',
        'scriptsfoot' => '<script></script>',
        'googlemaps' => '<script></script>',
        'facebook' => $faker->freeEmailDomain(),
        'instagram' => $faker->freeEmailDomain(),
        'twitter' => $faker->freeEmailDomain(),
        'youtube' => $faker->freeEmailDomain(),
        'telefone' => $faker->e164PhoneNumber(),
        'email' => $faker->freeEmail(),
        'endereco' => $faker->address(),
    ];
});