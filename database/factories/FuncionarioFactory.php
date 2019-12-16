<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Funcionario;
use Faker\Generator as Faker;

$factory->define(Funcionario::class, function (Faker $faker) {
    return [
		  'nome' => $faker->name,
		  'cargo' => $faker->numberBetween(1, 3),
		  'endereco' => $faker->address,
		  'telefone' => $faker->phoneNumber,
		  'nascimento' => $faker->dateTimeBetween(
				$startDate = '-40 years',
				$endDate = '-20 years',
				$timezone = null
			)->format('Y-m-d')
    ];
});
