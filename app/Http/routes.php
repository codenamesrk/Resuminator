<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });
// Route::post('payment', function(){
// 	return 'Payment';
// });

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

Route::group(['domain' => env('CLIENT_URL','pregnancy.ly'), 'as' => 'user::' ], function(){	

	Route::group(['middleware' => ['web']], function(){
		// Auth Route
		Route::auth();	
	});

	Route::group(['middleware' => ['web','loggedIn']], function(){
		Route::get('/', ['as' => 'welcome', 'uses' => 'UserController@welcome'] );				
		Route::get('register/', ['as' => 'register', 'uses' => 'RegistrationController@getRegister']);
		Route::post('register/', ['as' => 'post.register', 'uses' => 'RegistrationController@postRegister']);		
		Route::get('register/{user}', ['as' => 'register.get.profile', 'uses' => 'RegistrationController@getRegisterProfile']);
		Route::post('register/{user}', ['as' => 'register.post.profile', 'uses' => 'RegistrationController@postRegisterProfile']);			
	});

	Route::group(['middleware' => ['user','paycheck']], function(){
		Route::get('payment', ['as' => 'payment.resume', 'uses' => 'RegistrationController@getPayment']);
		Route::post('payment', ['as' => 'payment.post.resume', 'uses' => 'RegistrationController@postPayment']);				
	});

	Route::group(['middleware' => ['user','paid']], function(){
		Route::get('share', [ 'as' => 'invite.contacts', 'uses' => 'RegistrationController@invite']);
		Route::get('contact/import/google', [ 'as'=>'google.import', 'uses'=>'RegistrationController@importGoogleContact']);
		Route::get('upload', ['as' => 'upload.resume', 'uses' => 'RegistrationController@upload']);
		Route::post('upload', [ 'as' => 'submit.resume', 'uses' => 'RegistrationController@submit']);
	});

	Route::group(['middleware' => ['user','completed']], function(){
		Route::get('dashboard', [ 'as' => 'dashboard', 'uses' => 'UserController@index']);
		Route::get('report/{report}', [ 'as' => 'report', 'uses' => 'UserController@getReport']);
		Route::post('report/file/{file}', [ 'as' => 'report.file', 'uses' => 'UserController@getFile' ]);
	});
			
	Route::post('payment/response', ['middleware' => 'verifyDomain', 'as' => 'payment.response', 'uses' => 'RegistrationController@paymentResponse' ]);
	
});


Route::group(['domain' => env('ADMIN_URL','admin.pregnancy.ly'), 'as' => 'admin::'], function () {
	Route::group([ 'middleware' => ['web']], function () {
		// Auth Route
		Route::auth();
		// App Routes
		
	});
	Route::group(['middleware' => ['admin']], function(){
		Route::get('/', [ 'as' => 'dashboard', 'uses' => 'AdminController@welcome' ]);
	    // Route::get('home', [ 'as' => 'dashboard', 'uses' => 'AdminController@index' ]);
	    Route::get('users', [ 'as' => 'dashboard.users', 'uses' => 'AdminController@getUsers' ]);
	    Route::get('users/{user}/timeline', [ 'as' => 'dashboard.user.timeline', 'uses' => 'AdminController@getUserTimeline' ]);

	    Route::get('resumes/all', [ 'as' => 'dashboard.resumes', 'uses' => 'AdminController@getResumes' ]);	   	
	    Route::get('resumes/new', [ 'as' => 'dashboard.resumes.new', 'uses' => 'AdminController@getNewResumes' ]);	   	
	    Route::get('resumes/review/{resume}', [ 'as' => 'dashboard.review', 'uses' => 'AdminController@getReview' ]);	    
		Route::post('resumes/review', [ 'as' => 'dashboard.postReview', 'uses' => 'AdminController@postReview' ]);	    
		Route::post('resumes/file/{file}', [ 'as' => 'dashboard.resume.file', 'uses' => 'AdminController@getFile' ]);

	    Route::get('payments', [ 'as' => 'dashboard.payments', 'uses' => 'AdminController@getPayments' ]);
		Route::post('payments', [ 'as' => 'dashboard.post.payments', 'uses' => 'AdminController@postPayments' ]);

	    Route::get('reports', [ 'as' => 'dashboard.reports', 'uses' => 'AdminController@getReports' ]);
	    Route::get('reports/{report}', [ 'as' => 'dashboard.showReport', 'uses' => 'AdminController@showReport' ]);
		Route::get('reports/edit/{report}', ['middleware' => ['editable'], 'as' => 'dashboard.edit.report', 'uses' => 'AdminController@getEditReport' ]);
		Route::post('reports/edit/', [ 'as' => 'dashboard.save.report', 'uses' => 'AdminController@postEditReport' ]);
		Route::post('reports/generate/', [ 'as' => 'dashboard.generate.report', 'uses' => 'AdminController@generateReport' ]);
		Route::post('reports/file/{file}', [ 'as' => 'dashboard.report.file', 'uses' => 'AdminController@getFile' ]);

		Route::get('dropoffs', [ 'as' => 'dashboard.dropoffs', 'uses' => 'AdminController@getDropoffs' ]);

		Route::get('parameters', [ 'as' => 'dashboard.parameters', 'uses' => 'AdminController@getParameters' ]);
		// Route::get('parameters/create', [ 'as' => 'dashboard.create.parameter', 'uses' => 'AdminController@createParameter' ]);
		Route::post('parameters/create', [ 'as' => 'dashboard.save.parameter', 'uses' => 'AdminController@saveParameter' ]);		
		Route::get('parameters/edit/{parameter}', [ 'as' => 'dashboard.edit.parameter', 'uses' => 'AdminController@editParameter' ]);
		Route::post('parameters/update/', [ 'as' => 'dashboard.update.parameter', 'uses' => 'AdminController@updateParameter' ]);
		Route::delete('parameters/delete/{parameter}', ['as' => 'dashboard.delete.parameter', 'uses' => 'AdminController@destroy']);		
		Route::get('parameters/test', ['uses' => 'AdminController@test']);
		Route::post('parameters/test', ['as' => 'testpost', 'uses' => 'AdminController@testPost']);
		
	});

	Route::group(['middleware' => ['payment']], function(){		
		Route::post('payments/response', [ 'as' => 'dashboard.payments.response', 'uses' => 'AdminController@response' ]);
	});
	// Entrust::routeNeedsRole('home', 'admin', Redirect::to('/'));
});

