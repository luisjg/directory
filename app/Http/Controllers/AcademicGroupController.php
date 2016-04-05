<?php namespace App\Http\Controllers;

use App\Handlers\HandlerUtilities;

use App\Http\Controllers\Controller;
use App\Models\AcademicGroup;
use App\Models\Person;
use App\Models\DepartmentUser;
use App\Models\Department;

class AcademicGroupController extends Controller {

	/**
	 * Retrieves all the AcademicGroups
	 * @return Response the JSON response
	 */
	public function showAllAcademicGroups()
	{
		$colleges = AcademicGroup::where('department_id', 'LIKE', 'academic\_groups:%')->with('departments')->get();
		return $colleges;	
	}

	/**
	 * Retrieves all the Academic Group chairs
	 * @return Response The JSON Response
	 */
	public function showAllAcademicGroupChairs()
	{
		$chairs = Person::whereHas('departmentUser', function($q) {
			$q->where('role_name', 'chair')->orderBy('last_name');
		})->get();
		return $chairs;
	}

	/**
	 * Retrieves the chairs of a specific college
	 * @param  String $college_id the given college id
	 * @return Response The JSON Response
	 */
	public function showAcademicGroupChairs($college_id)
	{
		$college = AcademicGroup::where('department_id','academic_groups:'.$college_id)
		->with('departments.chairs') 
		->get();
		return $college;
	}

/**
 * Retrieves all the Departments within a given college
 * @param  String $college_id the college id we're interested in
 * @return Response The JSON Response
 */
	public function showDepartmentsInAcademicGroup($college_id)
	{
		$college = AcademicGroup::where('department_id', 'academic_groups:'.$college_id)
		->with('departments') 
		->get();
		return $college;
	}

	/**
	 * Retrives the chair in a given AcademicGroup
	 * @param  String $college_id the given college we're interested in
	 * @return Response The JSON Response
	 */
	public function showDepartmentChairsInAcademicGroups($college_id)
	{
		$college = AcademicGroup::where('department_id', 'academic_groups:'.$college_id)->get();
		return $college->departments;
	}


}

