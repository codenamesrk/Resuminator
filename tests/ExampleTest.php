<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Laracasts\TestDummy\Factory;
use Laracasts\TestDummy\DbTestCase;

class ExampleTest extends TestCase
{
    public function setUp(){
        parent::setUp();
        // Artisan::call('migrate');  
    }
    /**
     * A basic functional test example.
     *
     * @return void
     */
    public function testBasicExample()
    {
        // $profile = Factory::create('App\Profile');        
        // dd($profile->toArray());
        $resumes = Factory::create('App\Resume');
        dd($resumes->toArray());
    }
}
