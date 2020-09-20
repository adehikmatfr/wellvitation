<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\User;
use App\Product;


use Faker\Generator as Faker;
use Illuminate\Support\Facades\Hash;


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

$factory->define(User::class, function (Faker $faker) {
    $api_token = generateRandomString();
    return [
                'name' => $faker->name,
               'email' => $faker->unique()->safeEmail,
               'password' =>Hash::make('12345678'),
               'role_id' => rand(2,5),
               'phone' => $faker->e164PhoneNumber,
               'photo' => 'default.jpg',
               'isAdmin' => 1,
               'api_token' => $api_token
    ];
});

$factory->define(Product::class, function (Faker $faker) {
    return [
        'name_products' => $faker->word,
        'price' => rand(0,1000000),
        'detail' => $faker->text,
        'domain' => $faker->safeEmailDomain,
        'fitur' => $faker->text,
    ];
});

$factory->define(\App\Voucher::class, function (Faker $faker) {
    return [
        'name_voucher' =>$faker->word,
        'code_voucher' => $faker->userName,
        'discount' => rand(0,99),
        'mix_discount' => rand(0,99),
        'mix_usage' => rand(0,99),
        'count' => rand(0,500000),
        'status' => rand(0,1),
        'expired_date' => $faker->date
    ];
});

$factory->define(\App\Description::class, function (Faker $faker) {
    return [
        'web_name' => $faker->domainName,
        'event_name' => $faker->word,
        'event_desc' => $faker->text,
        'akad_place' => $faker->cityPrefix,
        'akad_address' => $faker->streetAddress,
        'akad_date' => $faker->date,
        'marriage_place' => $faker->cityPrefix,
        'marriage_address' => $faker->streetAddress,
        'marriage_date' => $faker->date,
        'description' => $faker->text,
        'message' => $faker->text,
        'youtube_link' => $faker->url,
        'asset_link' => $faker->url,
    ];
});

$factory->define(\App\Bride::class, function (Faker $faker) {
    return [
        'bridegroom_name' => $faker->word,
        'bridegroom_religion' => $faker->word,
        'bridegroom_guardian' => $faker->word,
        'bridegroom_bio' => $faker->text,
        'bridegroom_social' => $faker->url,
        'bride_name' => $faker->word,
        'bride_religion' => $faker->word,
        'bride_guardian' => $faker->word,
        'bride_bio' => $faker->text,
        'bride_social' => $faker->url
    ];
});