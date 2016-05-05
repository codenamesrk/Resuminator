<?php

use Illuminate\Database\Seeder;
use App\Parameter;

class ParameterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	Parameter::create([
    		'name' => 'Parameter 1'
    	]);
    }
}
