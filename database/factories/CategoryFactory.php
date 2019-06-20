<?php

use Faker\Generator as FakerGenerator;
/* @var $factory \Illuminate\Database\Eloquent\Factory */

$fakerTR = Faker\Factory::create('tr_TR');

$factory->define(App\Models\Song\Category::class, function (Faker\Generator $faker) use ($fakerTR) {

    // Fake words generate for EN
    $titleEn = $faker->text(15);

    // Fake words generate for TR
    $titleTr = $fakerTR->text(15);

    return [
        'thumbnail' => $faker->imageUrl(400, 400),
        'name:tr'   => $titleTr,
        'name:en'   => $titleEn
    ];
});


