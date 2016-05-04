<?php

use Illuminate\Database\Seeder;

class ResumeReviewSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Reviews
        App\Review::create([
        	'name' => 'not_reviewed'
        ]);
        App\Review::create([
        	'name' => 'reviewing'
        ]);
        App\Review::create([
        	'name' => 'reviewed'
        ]);

        // Resumes
        // factory(App\Resume::class,5)->create();
    }
}
