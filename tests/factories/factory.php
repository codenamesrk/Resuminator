<?php
$factory('App\User', [   
   'email' => $faker->email,   
   'password' => 'password',
]);
$factory('App\Profile', [
   'user_id' => 'factory:App\User',
   'first_name' => $faker->firstName,
]);
$factory('App\Resume', [
   'user_id' => 'factory:App\User',
   'name' => $faker->firstName,
   'location' => $faker->uuid,
]);