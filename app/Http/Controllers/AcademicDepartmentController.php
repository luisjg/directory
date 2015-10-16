<?php namespace App\Http\Controllers;

use App\Handlers\HandlerUtilities;

use App\Http\Controllers\Controller;
use Request;

use App\Models\AcademicDepartment;
use App\Models\Contact;
use App\Models\Person;


class AcademicDepartmentController extends Controller {

	/**
	 * Display a listing of the people in the given department.
	 *
	 * @param integer $dept_id The ID of the academic department
	 * @return Response
	 */

	public function showAcademicDepartments()
	{
		// RETURN DEPARTM
		$academicDepts = AcademicDepartment::where('entity_type', 'Academic Department')	
			->get();
		// convert the collection to an array for use in returning the
		// desired response as JSON
		$data = $academicDepts->toArray();

		// send the response
		return $this->sendResponse($data);

	}
	public function showAcademicDepartment($dept_id)
	{
		// RETURN DEPARTM
		$academicDepts = Contact::whereHas('contactDepartment', function($q) use ($dept_id) {
			$q->where('entities_id', 'academic_departments:'.$dept_id);
		})	
			->orderBy("entities_id")
			->get();

		// convert the collection to an array for use in returning the
		// desired response as JSON
		$data = $academicDepts->toArray();

		// send the response
		return $this->sendResponse($data);

	}

	public function showPeople($dept_id)
	{
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

		// convert the collection to an array for use in returning the
		// desired response as JSON
		$data = $persons->toArray();

		// send the response
		return $this->sendResponse($data);
	}

}
