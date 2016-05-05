<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Profile;

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
        $user->email = 'admin@superuser.com';
        $user->password = bcrypt(str_random(10));
        $user->remember_token = str_random(10);
        $user->verification_code = str_random(10);
        $user->verified = 1;
        $user->last_login = null;
        $user->ip = null;        
        $user->has_paid = null;
        $user->save();

        $profile = new Profile();             
        $profile->first_name = 'Admin',
        $profile->last_name = 'SuperUser',
        $profile->mobile = 9845613321,
        $profile->image_url = null
        $user->profile()->save($profile);
    ];
    }
}
