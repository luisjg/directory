<?php namespace App\Http\Controllers;

use App\Handlers\HandlerUtilities;
use App\Http\Controllers\Controller;
use App\Models\AcademicDepartment;
use App\Models\AdministrativeDepartment;
use App\Models\Contact;
use App\Models\Department;
use App\Models\Person;
use Request;

class DepartmentController extends Controller {

	/**
	 * Display a listing of the people in the given department.
	 *
	 * @param integer $dept_id The ID of the academic department
	 * @return JSON Response
	 */
	public function showAllMembersInDepartment($dept_id) {

		$persons = Person::with('contacts')->where('parent_entities_id', 'departments:'.$dept_id)
			->orderBy('last_name')->orderBy('first_name')
			->get();
		// check for a null $persons
		if($persons->isEmpty()) {
			// RETURN PEOPLE WHO HAVE DEPARTMENT
			$persons = Person::whereHas('departmentUser', function($q) use ($dept_id) {
				$q->where('department_id', 'academic_departments:'.$dept_id);
			})
			// GRAB THE IMAGE
			->with('image')
			// ONLY LOAD THE DEPARTMENT REQUESTED (makes using first() ok below)
			->with(['departmentUser' => function($q) use ($dept_id) {
				$q->where('department_id', 'academic_departments:'.$dept_id);
			}])
			->orderBy('last_name')->orderBy('first_name')
			->get();
		}

		// convert the collection to an array for use in returning the
		// desired response as JSON
		$data = $persons->toArray();
		// send the response
		return $this->sendResponse($data, "people");
	}
	/**
	 * Returns all academic departmentUser
	 * @return JSON Response
	 */
	public function showAllDepartments() {
		// return all the academic departments
		$academicDepts = AcademicDepartment::where('entity_type', 'Academic Department')	
			->get();
		// convert the collection to an array for use in returning the
		// desired response as JSON
		$data = $academicDepts->toArray();

		// send the response
		return $this->sendResponse($data, "department");
	}

	/**
	 * Shows all the administrative departmens
	 * @return JSON Response
	 */
	public function showAllAdministrativeDepartments() {
		$administrativeDept = AdministrativeDepartment::all();
		$data = $administrativeDept->toArray();
		return $this->sendResponse($data, "department");
	}

	/**
	 * Returns a specific department by $dept_id
	 * @param  String $dept_id 
	 * @return JSON Response
	 */
	public function showSpecificDepartment($dept_id) {
		$department = AcademicDepartment::where('department_id', 'academic_departments:'.$dept_id)->with('contacts')->first();
		if(is_null($department)){
			$department = AdministrativeDepartment::findOrFail('departments:'.$dept_id);
			$department = AdministrativeDepartment::where('entities_id', 'departments:'.$dept_id)->get();
		}
		$data = $department->toArray();
		return $this->sendResponse($data, "department");
	}
}
