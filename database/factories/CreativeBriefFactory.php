<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\CreativeBrief;
use Faker\Generator as Faker;

$factory->define(CreativeBrief::class, function (Faker $faker) {

    return [
        'campaign_id' => $faker->randomDigitNotNull,
        'creative_brief_name' => $faker->word,
        'creative_brief_file' => $faker->word,
        'created_at' => $faker->date('Y-m-d H:i:s'),
        'updated_at' => $faker->date('Y-m-d H:i:s')
    ];
});
