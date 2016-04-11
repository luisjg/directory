<?php namespace App\Http\Controllers;

use App\Handlers\HandlerUtilities;

use App\Http\Controllers\Controller;
use Request;
use App\Models\Department;
use App\Models\AcademicDepartment;
use App\Models\Contact;
use App\Models\Person;


class AcademicDepartmentController extends Controller {

	/**
	 * Display a listing of the people in the given department.
	 *
	 * @param integer $dept_id The ID of the academic department
	 * @return Response The JSON Response
	 */
	public function showAllAcademicDepartments()
	{
		//return Information for ALL departments
		$academicDepts = AcademicDepartment::where('entity_type', 'Academic Department')	
			->get();
		// convert the collection to an array for use in returning the
		// desired response as JSON
		$data = $academicDepts->toArray();

		// send the response
		return $this->sendResponse($data);

	}

	/**
	 * Retrieves a specific Academic Department by given id
	 * @param  String $dept_id the given academic department
	 * @return Response The JSON Response
	 */
	public function showSpecificAcademicDepartment($dept_id)
	{
		$department = AcademicDepartment::where('department_id', 'academic_departments:'.$dept_id)->with('contacts')->first();
		return $this->sendResponse($department);
	}
	
	/**
	 * Retrieves all the members ina department
	 * @param  String $dept_id the given department id
	 * @param  String $length  the length of the details wanted
	 * @return Response The JSON Response
	 */
	public function showAllMembers($dept_id, $length)
	{
		// RETURN PEOPLE WHO HAVE DEPARTMENT
		$data;
		if ($length == 'full') {
			$members = Person::whereHas('departmentUser', function($q) use ($dept_id) {
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
			$data = $members->toArray();
		}

		else if ($length == 'brief') {
			$members = Person::findMembersByDepartment($dept_id)
			->select('first_name', 'last_name','display_name', 'email', 'rank')->get();
			$data = $members->toArray();
		}

		return $this->sendResponse($data);
	}

	/**
	 * Retrieves a person that belongs to a specific department
	 * @param  String $dept_id the given department id
	 * @param  String $email   the given email address
	 * @return Response The JSON response
	 */
	public function showDeptSpecificPerson($dept_id, $email)
	{
		//{dept_id}/members/{email}
		$contact = Contact::with('person')->where(function($query) use($dept_id, $email){
			$query->where('parent_entities_id','academic_departments:'.$dept_id)
				  ->where('email', $email);
		})->first();
		$data = $contact->toArray();
		
		// send the response
		return $this->sendResponse($data);
	}
}
