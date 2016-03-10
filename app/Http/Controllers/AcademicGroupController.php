<?php namespace App\Http\Controllers;

use App\Handlers\HandlerUtilities;

use App\Http\Controllers\Controller;
use App\Models\AcademicGroup;
use App\Models\Person;
use App\Models\DepartmentUser;
use App\Models\Department;

class AcademicGroupController extends Controller {

	public function showAllAcademicGroups() {
		$colleges = AcademicGroup::where('department_id', 'LIKE', 'academic\_groups:%')->with('departments')->get();
		return $colleges;	
	}

	/**
	 * Shows all the college chairs
	 * @return Response
	 */
	public function showAllAcademicGroupChairs() {
		$chairs = Person::whereHas('departmentUser', function($q) {
			$q->where('role_name', 'chair')->orderBy('last_name');
		})->get();
		return $chairs;
	}

	/**
	 * Pulls in the chairs of a specific college
	 * @param  String $college_id the college id code
	 * @return Response
	 */
	public function showAcademicGroupChairs($college_id) {
		$college = AcademicGroup::where('department_id','academic_groups:'.$college_id)
		->with('departments.chairs') 
		->get();
		return $college;
	}

	public function showDepartmentsInAcademicGroup($college_id) {
		$college = AcademicGroup::where('department_id', 'academic_groups:'.$college_id)
		->with('departments') 
		->get();
		return $college;
	}

	public function showDepartmentChairsInAcademicGroups($college_id) {
		$college = AcademicGroup::where('department_id', 'academic_groups:'.$college_id)->get();
		return $college->departments;
	}


}

