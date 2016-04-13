<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

use App\User;
use Illuminate\Support\Facades\Hash;

$factory->define(App\User::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->email,
        'password' => Hash::make('testing'),
        'birth_date_at' => $faker->dateTimeThisCentury,
        'phone_number' => $faker->phoneNumber,
        'gender' => 'male',
        'created_at' => $faker->dateTimeThisYear,
        'updated_at' => $faker->dateTimeThisMonth
    ];
});

$factory->define(App\AudioBook::class, function (Faker\Generator $faker) {
    return [
        'title' => $faker->sentence(2),
        'subtitle' => $faker->sentence(3),
        'author' => $faker->name,
        'narrator' => $faker->name,
        'isbn' => $faker->isbn13,
        'price' => $faker->numberBetween(5000, 600000),
        'about' => $faker->sentence,
        'duration_seconds' => $faker->numberBetween(5000, 40000),
        'cover_picture_url' => 'http://static1.squarespace.com/static/5400e40be4b08161ea5c9b92/t/54bdc47de4b05e8a364b77d9/1421722750932/',
        'banner_picture_url' => 'http://www.youngpeoplestheatre.ca/wp-content/uploads/2014/06/showpage-mockingbird.jpg',
        'copyright_year' => $faker->year,
        'visibility' => 1,
        'released_at' => $faker->dateTimeThisDecade,
        'created_at' => $faker->dateTimeThisYear,
        'updated_at' => $faker->dateTimeThisMonth
    ];
});

$factory->define(App\AudioBookChapter::class, function (Faker\Generator $faker) {
    return [
        'title' => $faker->sentence(2),
        'subtitle' => $faker->sentence(3),
        'price' => $faker->numberBetween(1000, 50000),
        'about' => $faker->sentence,
        'cover_picture_url' => 'http://static1.squarespace.com/static/5400e40be4b08161ea5c9b92/t/54bdc47de4b05e8a364b77d9/1421722750932/',
        // TODO: Add Dummy AudioBook MP3
        'created_at' => $faker->dateTimeThisYear,
        'updated_at' => $faker->dateTimeThisMonth
    ];
});

$factory->define(App\Collection::class, function (Faker\Generator $faker) {
    return [
        'title' => $faker->sentence(2),
        'subtitle' => $faker->sentence(3),
        'about' => $faker->sentence,
        'picture_url' => 'http://www.backpackbudapest.hu/wp-content/uploads/2015/11/Budapest_Opera_interior.jpg',
        'visibility' => 1,
        'created_at' => $faker->dateTimeThisYear,
        'updated_at' => $faker->dateTimeThisMonth
    ];
});

$factory->define(App\Purchase::class, function (Faker\Generator $faker) {
    return [
        'price' => $faker->numberBetween(5000, 600000),
        'created_at' => $faker->dateTimeThisYear,
        'updated_at' => $faker->dateTimeThisMonth
    ];
});

$factory->define(App\Category::class, function (Faker\Generator $faker) {
    return [
        'title' => $faker->sentence(1),
        'subtitle' => $faker->sentence(3),
        'picture_url' => 'http://www.backpackbudapest.hu/wp-content/uploads/2015/11/Budapest_Opera_interior.jpg',
        'about' => $faker->sentence,
        'created_at' => $faker->dateTimeThisYear,
        'updated_at' => $faker->dateTimeThisMonth
    ];
});

$factory->define(App\Review::class, function (Faker\Generator $faker) {
    return [
        'content' => $faker->sentence(15),
        'rating' => $faker->randomFloat(5, 1),
        'user_id' => User::all()->random(1)->id,
        'created_at' => $faker->dateTimeThisYear,
        'updated_at' => $faker->dateTimeThisMonth
    ];
});