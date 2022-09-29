<?php

namespace App\Http\Controllers;

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
		// $colleges = AcademicGroup::where('department_id', 'LIKE', 'academic\_groups:%')->with('departments')->get();
		$colleges = AcademicGroup::with('departments')
					->where('department_id', 'LIKE', 'academic\_groups:%')
					->get();
		return $this->sendResponse($colleges, "colleges");	
	}

	/**
	 * Retrieves all the Academic Group chairs
	 * @return Response The JSON Response
	 */
	public function showAllAcademicGroupChairs()
	{
		$chairs = Person::whereHas('departmentUser', function($q) {
			$q->where('role_name', 'chair')->orderBy('last_name');
			$q->where('confidential', 0);
		})->get();
		return $this->sendResponse($chairs, "people");
	}

	/**
	 * Retrieves the chairs of a specific college
	 * @param  String $college_id the given college id
	 * @return Response The JSON Response
	 */
	public function showAcademicGroupChairs($college_id)
	{
		$college = AcademicGroup::with('departments.chairs', 'departments.chairs.image')
				   ->where('department_id', 'academic_groups:'.$college_id)
				   ->firstOrFail();
		return $this->sendResponse($college, "college");
	}

	/**
	 * Retrieves all the Departments within a given college
	 * @param  String $college_id the college id we're interested in
	 * @return Response The JSON Response
	 */
	public function showDepartmentsInAcademicGroup($college_id)
	{
		$college = AcademicGroup::with('departments')
				   ->where('department_id', 'academic_groups:'.$college_id)
				   ->firstOrFail();
		return $this->sendResponse($college, "department");
	}
}

