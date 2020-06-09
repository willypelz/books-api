<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Application;
use App\Models\ApplicationDetails;
use App\Models\ApplicationRole;
use App\Models\Book;
use App\Models\Role;
use App\Models\User;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

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


//Role Factory
$factory->define(Book::class, function (Faker $faker) {
    return [
        'name' => 'Asefon-michael',
        'isbn' => '1293-234-ael',
        'authors' => 'williams Michael, Asefon Pelumi',
        'number_of_pages' => 25,
        'publisher' => 'pelumiasefon@gmail.com',
        'country' => 'Nigeria',
        'release_date' => '2020-06-09',
    ];
});
