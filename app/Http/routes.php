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


//begin new REST-ful API


	// academic department information
	// Example: /academic_departments/
$app->get('academic_departments/', 'AcademicDepartmentController@showAcademicDepartments');
$app->get('academic_departments/{dept_id}', 'AcademicDepartmentController@showAcademicDepartment');
$app->get('academic_departments/{dept_id}/members', 'AcademicDepartmentController@showPeople');
//access contact info by email addresses
$app->get('academic_departments/{dept_id}/members/{email}','AcademicDepartmentController@showPerson');
$app->get('academic_departments/members/{email}','AcademicDepartmentController@showPerson');
$app->get('/members/{email}','AcademicDepartmentController@showPerson');

	// committee information
	// Example: /api/committees/atc/people
	//$app->get('committees/{committee_id}/people', 'CommitteeController@showPeople');


