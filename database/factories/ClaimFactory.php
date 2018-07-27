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

$factory->define(App\Claim::class, function (Faker $faker) {
    $user = factory('App\User')->create();
    $rail = factory('App\Rail')->create();
    $category = factory('App\Category')->create();
    return [
        'title'=>$faker->sentence(),
        'descr'=>$faker->paragraph(),
        'user_id'=>$user->id,
        'rail_id'=>$rail->id,
        'category_id'=>$category->id,

    ];
});
