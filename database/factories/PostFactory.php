<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

//use App\Model;
use App\Post;
use Illuminate\Support\Str;
use Faker\Generator as Faker;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Storage;

$factory->define(Post::class, function (Faker $faker) {
    $image = $faker->image();
    $imageFile = new File($image);
    return [
        //'title' => $faker->sentence(5),
        'caption' => $faker->text(),
        'user_id' => factory('App\User')->create()->id,
        //'image' => $faker->image('public/storage/uploads',640,480, null, false),
        //'image'=>'https://source.unsplash.com/random',

        'image' => Storage::disk('public')->putFile('images', $imageFile),

    ];
});
