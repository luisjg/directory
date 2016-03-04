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
	 * @return Response
	 */

	public function showAllAcademicDepartments()
	{//return Information for ALL departments
		$academicDepts = AcademicDepartment::where('entity_type', 'Academic Department')	
			->get();
		// convert the collection to an array for use in returning the
		// desired response as JSON
		$data = $academicDepts->toArray();

		// send the response
		return $this->sendResponse($data);

	}
	public function showSpecificAcademicDepartment($dept_id) {
		//return information pertaining to ONE department
		// $academicDepts = Contact::where('entities_id', 'academic_departments:'.$dept_id)
		// 	->first();

		
		// //if an email is provided instead of a department id:	
		// if (empty($academicDepts)){
		// 	$contact = Contact::where('email',$dept_id)
		// 		->first();
		// 	$data = $contact->toArray();
		// }
		// else
		// // convert the collection to an array for use in returning the
		// // desired response as JSON
		// 	$data = $academicDepts->toArray();

		// // send the response
		// return $this->sendResponse($data);
		$department = AcademicDepartment::where('department_id', 'academic_departments:'.$dept_id)->with('contacts')->first();
		return $this->sendResponse($department);

	}
	/**
	 * [showMembers returns all of the members in a department]
	 * @param  [id] $dept_id [description]
	 * @param  [String] $length  [description]
	 * @return [type]          [description]
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
	public function showDeptSpecificPerson($dept_id, $email) {
		//{dept_id}/members/{email}
		$contact = Contact::with('person')->where(function($query) use($dept_id, $email){
			$query->where('parent_entities_id','academic_departments:'.$dept_id)
				  ->where('email', $email);
		})->first();
		// convert the collection to an array for use in returning the
		// desired response as JSON
		//dd($contact);
	
		$data = $contact->toArray();
		
		// send the response
		return $this->sendResponse($data);
	}

	public function showAllDepartmentChairs() {
		$departmentChairs = Person::whereHas('departmentUser', function($q) {
			$q->where('role_name', 'chair')->orderBy('last_name');
		})->get();
		return $departmentChairs;
 	}	

}
