<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Profile;
use Carbon\Carbon;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		// factory(App\Profile::class,1)->create();    
		$user = new User();    
        $user->email = 'admin@superman.com';
        $user->password = bcrypt(str_random(10));
        $user->remember_token = str_random(10);
        $user->verification_code = str_random(10);
        $user->save();

        $profile = new Profile();             
        $profile->first_name = 'Admin';
        $profile->last_name = 'SuperUser';
        $profile->mobile = 9845613321;
        $user->profile()->save($profile);

    }
}
