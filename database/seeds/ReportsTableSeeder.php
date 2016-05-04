<?php

use Illuminate\Database\Seeder;

class ReportsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       
        // Creating Rough Reports
        factory(App\Report::class,4)->create();
        // Adding Paramters to Reports
		$faker = Faker\Factory::create();
		for ( $i = 1; $i < 4; $i++) // generate same no. of records as the no. in Report above
        { 
			$report = App\Report::whereId($i)->first();			
			for ( $j=1; $j < 6 ; $j++) { 
				$score = $faker->numberBetween($min = 1, $max = 100);
			   	$parameter = App\Parameter::whereId($j)->first();
			   	$report->parameters()->save($parameter, ['score' => $score, 'remark' => $faker->sentence($nbWords = 4)]);
			}   
		}   		
    }
}
