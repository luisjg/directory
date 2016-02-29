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

//Routes using the MemberController
/**
 * The URI will only be members/{individuals_id} or members/{email}
 * Doing members/id/{individual} and members/email/{email} for Steve to have two options.
 */
$app->group(['prefix' => 'members', 'namespace' => 'App\Http\Controllers'], function($app) {
	$app->get('/id/{individuals_id}', 'MemberController@showMemberById');
	$app->get('/email/{email}', 'MemberController@showMemberByEmail');
});

//Routes for Departments
// $app->group(['prefix' => 'departments', 'namespace' => 'App\Http\Controllers'], function($app) {
// 	$app->get('/', 'DepartmentController@showAllDepartments');
// 	$app->get('/{dept_id}/member/{email}', 'DepartmentController@showSpecificDepartment');
// });


//Routes for AdministrativeDepartments
$app->group(['prefix' => 'administrative_departments', 'namespace' => 'App\Http\Controllers'], function($app){
	$app->get('/','AdministrativeDepartmentController@showAllAdministrativeDepartments');
	$app->get('/{dept_id}','AdministrativeDepartmentController@showPeople');
	$app->get('/{dept_id}/members/{email}','AdministrativeDepartmentController@showDeptSpecificPerson');
	$app->get('/id/{member_id}', 'AdministrativeDepartmentController@showPersonByID');
});

// $app->get('departments/{dept_id}/members', 'DepartmentController@showDepartmentMembers');
// $app->get('departments/{dept_id}/members', 'DepartmentController@showMembersByDepartment1');

// //length would either be full or brief
// $app->get('departments/{dept_id}/members/{length}', 'DepartmentController@showMembersByDepartment');
// //show the department chairs for every single department
// $app->get('departmentchairs/list', 'DepartmentController@showAllDepartmentChairs');
// $app->get('departments/{dept_id}/members/email/{email}', 'DepartmentController@showPersonInDepartment');

//Routes for AcademicDepartments
$app->group(['prefix' => 'academic_departments', 'namespace' => 'App\Http\Controllers'], function($app) {
	$app->get('/', 'AcademicDepartmentController@showAllAcademicDepartments');
	$app->get('/{dept_id}', 'AcademicDepartmentController@showSpecificAcademicDepartment');
	$app->get('/{dept_id}/members/{length}', 'AcademicDepartmentController@showAllMembers');
	$app->get('/{dept_id}/member/{email}', 'AcademicDepartmentController@showDeptSpecificPerson');
	$app->get('/department_chairs/list', 'AcademicDepartmentController@showAllDepartmentChairs');
});


//Routes for Committees
// $app->get('committees', 'CommitteeController@showCommittees');
// $app->get('committees/{committee_id}/members', 'CommitteeController@showMembers');
// $app->get('committees/{committee_id}', 'CommitteeController@showCommitteeMembers');

//Routes for Colleges
$app->group(['prefix' => 'colleges', 'namespace' => 'App\Http\Controllers'], function ($app) {
	$app->get('/', 'AcademicGroupController@showAllAcademicGroups');
	$app->get('/{dept_id}', 'AcademicGroupController@showDepartmentsInAcademicGroup');
	$app->get('/{dept_id}/department_chairs/list', 'AcademicGroupController@showDepartmentChairsInAcademicGroups');
});




// $app->get('departments/{dept_id}/members', 'PersonController@showSpecificMember');
// $app->get('departmentchairs/members');

// all API data routes are prefixed with /api
// $app->group(['prefix' => 'api', 'namespace' => 'App\Http\Controllers'], function($app) {

// 	// academic department information
// 	// Example: /api/departments/189/people2
// 	$app->get('departments/{dept_id}/people', 'DepartmentController@showPeople');

// 	// committee information
// 	// Example: /api/committees/atc/people
// 	$app->get('committees/{committee_id}/people', 'CommitteeController@showPeople');

// });


// begin new REST-ful API


// 	academic department information
// 	Example: /academic_departments/
// $app->group(['prefix' => 'academic_departments', 'namespace' => 'App\Http\Controllers'], function($app){
// 	$app->get('/', 'AcademicDepartmentController@showAcademicDepartments');
// 	$app->get('/{dept_id}', 'AcademicDepartmentController@showAcademicDepartment');
// 	$app->get('/{dept_id}/members', 'AcademicDepartmentController@showPeople');
// //access contact info by email addresses
	// $app->get('/{dept_id}/members/{email}','AcademicDepartmentController@showDeptSpecificPerson');
// 	$app->get('/members/{email}','AcademicDepartmentController@showPerson');
// 	$app->get('/mid/{member_id}', 'AcademicDepartmentController@showPersonByMID');
// });

// $app->get('/members/{email}','AcademicDepartmentController@showPerson');



// $app->group(['prefix' => 'committees', 'namespace' => 'App\Http\Controllers'], function($app){
// 	// committee information
// 	// Example: /committees/atc/people
// 	$app->get('/', 'CommitteeController@showCommittees');
// 	$app->get('/{committee_id}', 'CommitteeController@showCommitteeMembers');
// 	$app->get('/mid/{member_id}','CommitteeController@showCommitteesByPerson');

// });




