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

$factory->define(App\User::class, function (Faker\Generator $faker) {
    return [        
        'email' => $faker->safeEmail,
        'password' => bcrypt(str_random(10)),
        'remember_token' => str_random(10),
        'verification_code' => str_random(10),
        'verified' => $faker->boolean($chanceOfGettingTrue = 50),
        'last_login' => $faker->dateTime(),
        'ip' => $faker->ipv4,
        'created_at' => $faker->dateTimeThisYear($max = 'now'),
        'has_paid' => $faker->boolean($chanceOfGettingTrue = 50),
    ];
});
$factory->define(App\Profile::class, function (Faker\Generator $faker) {
    return [        
         'user_id' => factory(App\User::class)->create()->id,
         'first_name' => $faker->firstName,
         'last_name' => $faker->lastName,
         'mobile' => $faker->phoneNumber,
         'image_url' => $faker->imageUrl($width = 640, $height = 480)       
    ];
});
$factory->define(App\Resume::class, function (Faker\Generator $faker) {
    $randie = App\User::orderByRaw('RAND()')->first();
    return [        
       'user_id' => $randie->id,
       'name' => $faker->firstName,
       'original_name' => $faker->lastName,
       'review_id' => $faker->numberBetween($min = 1, $max = 3)
    ];
});
$factory->define(App\Parameter::class, function (Faker\Generator $faker) {
    // $randie = App\User::orderByRaw('RAND()')->first();
    return [               
       'name' => $faker->state      
    ];
});
$factory->define(App\Payment::class, function (Faker\Generator $faker) {
    $randie = App\User::orderByRaw('RAND()')->first();
    $resume = App\Resume::orderByRaw('RAND()')->first();
    return [        
       'user_id' => $randie->id,
       'transaction_id' => $faker->randomNumber,
       'resume_id' => $resume->id,      
    ];
});
$factory->define(App\Report::class, function (Faker\Generator $faker) {
    $user = App\User::orderByRaw('RAND()')->first();
    $resume = App\Resume::orderByRaw('RAND()')->first();
    return [        
       'user_id' => $user->id,
       'resume_id' => $resume->id,
       'score' => $faker->numberBetween($min = 1, $max = 100),
       'gen_remark' => $faker->sentence($nbWords = 6)
    ];
});

// $factory->define(App\Report::class, function(Faker\Generator $faker){
//     return [
      
//     ];
// });
   