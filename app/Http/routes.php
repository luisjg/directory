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
$app->get('/about/version-history', 'WelcomeController@about');



//Route for Centers
$app->group(['prefix' => 'api/centers'], function($app) {
	$app->get('/', 'CenterController@showAllCenters');
	$app->get('/{center_id}', 'CenterController@showSpecificCenter');
	$app->get('/{center_id}/members', 'CenterController@showMembers');
});

//Routes for Colleges
$app->group(['prefix' => 'api/colleges'], function ($app) {
	$app->get('/', 'AcademicGroupController@showAllAcademicGroups');
	$app->get('/chairs', 'AcademicGroupController@showAllAcademicGroupChairs');
	$app->get('/{college_id}', 'AcademicGroupController@showDepartmentsInAcademicGroup');
	$app->get('/{college_id}/chairs', 'AcademicGroupController@showAcademicGroupChairs');
});

//Routes for Committees
$app->group(['prefix' => 'api/committees'], function($app) {
	$app->get('/', 'CommitteeController@showCommittees');
	$app->get('/{committee_id}/members', 'CommitteeController@showMembers');
	$app->get('/{committee_id}', 'CommitteeController@showCommittee');
});

//Routes for Departments
$app->group(['prefix' => 'api/departments'], function($app) {
	$app->get('/', 'DepartmentController@showAllDepartments');
	$app->get('/administrative', 'DepartmentController@showAllAdministrativeDepartments');
	$app->get('/{dept_id}', 'DepartmentController@showSpecificDepartment');
	$app->get('/{dept_id}/members', 'DepartmentController@showAllMembersInDepartment');
	$app->get('/{dept_id}/faculty', 'DepartmentController@showFacultyInDepartment');
	$app->get('/{dept_id}/coordinator', 'DepartmentController@showGradCoordinatorInDepartment');
});

//Route for Institutes
$app->group(['prefix' => 'api/institutes'], function($app) {
	$app->get('/', 'InstituteController@showAllInstitutes');
	$app->get('/{institute_id}', 'InstituteController@showSpecificInstitute');
	$app->get('/{institute_id}/members', 'InstituteController@showMembers');
});

// Routes for Members
$app->group(['prefix' => 'api/members'], function($app) {
	// These are temporary
	$app->get('/email/{email}', 'MemberController@showMemberByEmail');
	$app->get('/email/{email}/degrees', 'MemberController@showMemberByEmailWithDegrees');
	// $app->get('/id/{individuals_id}', 'MemberController@showMemberById');
	// In the future this will be the only route here
	$app->get('/', 'MemberController@showMember');
	$app->get('/faculty', 'MemberController@showAllFaculty');
	$app->get('/faculty/tenure-track', 'MemberController@showAllTenureTracks');
	$app->get('/faculty/emeriti', 'MemberController@showAllEmeriti');
	$app->get('/faculty/lecturer', 'MemberController@showAllLecturers');

	//Post routes
	$app->post('/create',['middleware' => 'create', 'uses' => 'PersonController@addAffiliate']);
	$app->post('/delete',['middleware' => 'create', 'uses' => 'PersonController@removeAffiliate']);
});