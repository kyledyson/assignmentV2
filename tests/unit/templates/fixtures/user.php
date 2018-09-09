<?php

/**
 * @var $faker \Faker\Generator
 * @var $index integer
 */
$faker = Faker\Factory::create('en_GB');

return [
    'username' => $faker->name,
    'email' => $faker->unique()->email,
    'mobile_number' => $faker->regexify($regex = '[0-9]{11}'),
    'postcode' => $faker->postcode,
    'password' => 'password123'
];
