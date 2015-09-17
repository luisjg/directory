<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$app->get('/', 'WelcomeController@index');

// all API data routes are prefixed with /api
$app->group(['prefix' => 'api', 'namespace' => 'App\Http\Controllers'], function($app) {

	// academic department information
	// Example: /api/departments/189/people
	$app->get('departments/{dept_id}/people', 'DepartmentController@showPeople');

	// committee information
	// Example: /api/committees/atc/people
	$app->get('committees/{committee_id}/people', 'CommitteeController@showPeople');

});