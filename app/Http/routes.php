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

//Route for Centers
$app->group(['prefix' => 'centers', 'namespace' => 'App\Http\Controllers'], function($app) {
	$app->get('/', 'CenterController@showAllCenters');
	$app->get('/{center_id}', 'CenterController@showSpecificCenter');
	$app->get('/{center_id}/members', 'CenterController@showMembers');
});

//Routes for Colleges
$app->group(['prefix' => 'colleges', 'namespace' => 'App\Http\Controllers'], function ($app) {
	$app->get('/', 'AcademicGroupController@showAllAcademicGroups');
	$app->get('/chairs', 'AcademicGroupController@showAllAcademicGroupChairs');
	$app->get('/{college_id}', 'AcademicGroupController@showDepartmentsInAcademicGroup');
	$app->get('/{college_id}/chairs', 'AcademicGroupController@showAcademicGroupChairs');
});

//Routes for Committees
$app->group(['prefix' => 'committees', 'namespace' => 'App\Http\Controllers'], function($app) {
	$app->get('/', 'CommitteeController@showCommittees');
	$app->get('/{committee_id}/members', 'CommitteeController@showMembers');
	$app->get('/{committee_id}', 'CommitteeController@showCommittee');
	$app->get('member/{member_id}', 'CommitteeController@showCommitteesByMemberId');
});

//Routes for Departments
$app->group(['prefix' => 'departments', 'namespace' => 'App\Http\Controllers'], function($app) {
	$app->get('/', 'DepartmentController@showAllDepartments');
	$app->get('/administrative', 'DepartmentController@showAllAdministrativeDepartments');
	$app->get('/{dept_id}', 'DepartmentController@showSpecificDepartment');
	$app->get('/{dept_id}/members', 'DepartmentController@showAllMembersInDepartment');
});

//Route for Institutes
$app->group(['prefix' => 'institutes', 'namespace' => 'App\Http\Controllers'], function($app) {
	$app->get('/', 'InstituteController@showAllInstitutes');
	$app->get('/{institute_id}', 'InstituteController@showSpecificInstitute');
	$app->get('/{institute_id}/members', 'InstituteController@showMembers');
});

// Routes for Members
$app->group(['prefix' => 'members', 'namespace' => 'App\Http\Controllers'], function($app) {
	$app->get('/id/{individuals_id}', 'MemberController@showMemberById');
	$app->get('/email/{email}', 'MemberController@showMemberByEmail');
});