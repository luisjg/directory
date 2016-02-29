<?php namespace App\Http\Controllers;

use App\Handlers\HandlerUtilities;

use App\Http\Controllers\Controller;
use Request;
use App\Models\Contact;
use App\Models\Department;
use App\Models\Person;
use App\Models\DepartmentUser;


class DepartmentController extends Controller {

	/**
	 * Display a listing of the people in the given department.
	 *
	 * @param integer $dept_id The ID of the academic department
	 * @return Response
	 */
	public function showPeople($dept_id)
	{
		// // RETURN PEOPLE WHO HAVE DEPARTMENT
		// $persons = Person::whereHas('departmentUser', function($q) use ($dept_id) {
		// 	$q->where('department_id', 'academic_departments:'.$dept_id);
		// })->get();
		// // GRAB THE IMAGE
		// ->with('image')
		// // ONLY LOAD THE DEPARTMENT REQUESTED (makes using first() ok below)
		// ->with(['departmentUser' => function($q) use ($dept_id) {
		// 	$q->where('department_id', 'academic_departments:'.$dept_id);
		// }])
		// ->orderBy('last_name')->orderBy('first_name')
		// ->get();

		// // convert the collection to an array for use in returning the
		// // desired response as JSON
		// $data = $persons->toArray();
		// // send the response
		// return $this->sendResponse($data);
		// return $persons;
	}
	/**
	 * [showAllDepartments returns all Departments]
	 * url:  /departments
	 * @return [JSON] [description]
	 */
	public function showAllDepartments() {
		return $this->sendResponse(Department::all());
	}
	/**
	 * [showSpecificDepartment returns a specific department passed in by the $dept_id]
	 * @param  [int] $dept_id 
	 * @return [JSON]          [description]
	 */
	public function showSpecificDepartment($dept_id) {
		$department = Department::where('entities_id', 'departments:'.$dept_id)->get();
		return $this->sendResponse($department);
	}

	// public function showDepartmentMembers($dept_id) {
	// 	$members = Department::with('person')
	// 		->where('entities_id', 'departments:'.$dept_id)
	// 		->get();
	// 	return $this->sendResponse($members);
	// }

	// public function showSingleDepartment($dept_id) {
	// 	$department = Department::select('name', 'description', 'entity_type')
	// 	->where('department_id', 'academic_departments:'.$dept_id)->first();
	// 	return $this->sendResponse($department);
	// }

	// public function showMembersByDepartment1($dept_id) {
	// 		$members = Person::findMembersByDepartment($dept_id)->get();
	// 		return $members;
	// }

	// public function showMembersByDepartment($dept_id, $length) {

	// 	if ($length == "full") {
	// 		$members = Person::findMembersByDepartment($dept_id)->get();
	// 		return $members;
	// 	}

	// 	else if ($length == "brief") {
	// 		$members = Person::findMembersByDepartment($dept_id)
	// 		->select('first_name', 'last_name','display_name', 'email', 'rank')->get();
	// 		return $members;
	// 	}
	// }

	// public function showPersonInDepartment($dept_id, $email) {
	// 	$person = Person::
	// }
	



}
