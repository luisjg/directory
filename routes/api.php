<?php

//Route for Centers
$router->group(['prefix' => 'centers'], function($router) {
    $router->get('/', 'CenterController@showAllCenters');
    $router->get('/{center_id}', 'CenterController@showSpecificCenter');
    $router->get('/{center_id}/members', 'CenterController@showMembers');
});

//Routes for Colleges
$router->group(['prefix' => 'colleges'], function ($router) {
    $router->get('/', 'AcademicGroupController@showAllAcademicGroups');
    $router->get('/chairs', 'AcademicGroupController@showAllAcademicGroupChairs');
    $router->get('/{college_id}', 'AcademicGroupController@showDepartmentsInAcademicGroup');
    $router->get('/{college_id}/chairs', 'AcademicGroupController@showAcademicGroupChairs');
});

//Routes for Committees
$router->group(['prefix' => 'committees'], function($router) {
    $router->get('/', 'CommitteeController@showCommittees');
    $router->get('/{committee_id}/members', 'CommitteeController@showMembers');
    $router->get('/{committee_id}', 'CommitteeController@showCommittee');
});

//Routes for Departments
$router->group(['prefix' => 'departments'], function($router) {
    $router->get('/', 'DepartmentController@showAllDepartments');
    $router->get('/administrative', 'DepartmentController@showAllAdministrativeDepartments');
    $router->get('/{dept_id}', 'DepartmentController@showSpecificDepartment');
    $router->get('/{dept_id}/members', 'DepartmentController@showAllMembersInDepartment');
    $router->get('/{dept_id}/faculty[/{type}]', 'DepartmentController@showFacultyInDepartment');
    $router->get('/{dept_id}/faculty/{type}/degrees', 'DepartmentController@showFacultyInDepartmentWithDegrees');
    $router->get('/{dept_id}/coordinator', 'DepartmentController@showGradCoordinatorInDepartment');
});

//Route for Institutes
$router->group(['prefix' => 'institutes'], function($router) {
    $router->get('/', 'InstituteController@showAllInstitutes');
    $router->get('/{institute_id}', 'InstituteController@showSpecificInstitute');
    $router->get('/{institute_id}/members', 'InstituteController@showMembers');
});

// Routes for Members
$router->group(['prefix' => 'members'], function($router) {
    // These are temporary
    $router->get('/email/{email}', 'MemberController@showMemberByEmail');
    $router->get('/email/{email}/degrees', 'MemberController@showMemberByEmailWithDegrees');
    // $app->get('/id/{individuals_id}', 'MemberController@showMemberById');
    // In the future this will be the only route here
    $router->get('/', 'MemberController@showMember');
    $router->get('/faculty/{type}[/{letter}]', 'MemberController@showAllFaculty');
    $router->get('/faculty/{type}/degrees[/{letter}]', 'MemberController@showAllFacultyWithDegrees');

});
//Post routes
$router->group(['prefix' => 'members', 'middleware' => 'modify-data'], function($router) {
    $router->post('/delete', 'PersonController@removeAffiliate');
    $router->post('/create', 'PersonController@addAffiliate');
    $router->put('/update-info', 'PersonController@updateInfo');
});
