<?php

/**
 * @var $faker \Faker\Generator
 * @var $index integer
 */
$faker = Faker\Factory::create('en_GB');

return [
    'user_id' => $faker->numberBetween(0,10),
    'category_id' => $faker->numberBetween(0,10),
    'location_id' => $faker->numberBetween(0,10),
    'description' => $faker->text,
    'condition' => $faker->numberBetween(0,1),
    'price' => $faker->numberBetween(0,100),
];
