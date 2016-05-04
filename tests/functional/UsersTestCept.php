<?php 
$I = new FunctionalTester($scenario);
$I->wantTo('login');
$I->amOnPage('admin.resume.dev/login');
$I->fillField('email','johndoe@gmail.com');
$I->fillField('password','johndow');
$I->click('Login');
$I->see('Dashboard');