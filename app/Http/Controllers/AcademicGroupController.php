<?php namespace App\Http\Controllers;

use App\Handlers\HandlerUtilities;

use App\Http\Controllers\Controller;
use App\Models\AcademicGroup;

class AcademicGroupController extends Controller {

	public function showAllAcademicGroups() {
		$colleges = AcademicGroup::where('department_id', 'LIKE', 'academic\_groups:%')->with('departments')->get();
		return $colleges;	
	}

	public function showDepartmentsInAcademicGroup($dept_id) {
		$college = AcademicGroup::where('department_id', 'academic_groups:'.$dept_id)
		->with('departments')
		->get();
		return $college;
	}

	public function showDepartmentChairsInAcademicGroups($dept_id) {
		$college = AcademicGroup::where('department_id', 'academic_groups:'.$dept_id)->get();
		return $college->departments;
	}


}

