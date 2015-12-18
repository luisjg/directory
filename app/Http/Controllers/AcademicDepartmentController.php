<?php namespace App\Http\Controllers;

use App\Handlers\HandlerUtilities;

use App\Http\Controllers\Controller;
use Request;
use Validator;
use App\Models\AcademicDepartment;
use App\Models\Contact;
use App\Models\Person;
use DB;


class AcademicDepartmentController extends Controller {

	/**
	 * Display a listing of the people in the given department.
	 *
	 * @param integer $dept_id The ID of the academic department
	 * @return Response
	 */

	public function showAcademicDepartments()
	{//return Information for ALL departments
		
		$academicDepts = AcademicDepartment::where('entity_type', 'Academic Department')	
			//->orderBy('last_name')->orderBy('first_name')
			->get();
		// convert the collection to an array for use in returning the
		// desired response as JSON
		$data = $academicDepts->toArray();

		// send the response
		return $this->sendResponse($data);

	}
	public function showAcademicDepartment($dept_id)
	{//return information for people belonging to a specified department 
		$contact = DB::table('contacts')
			->where('department', 'academic_departments:'.$dept_id)
			->join('fresco.people', 'user_id', '=', 'fresco.people.individuals_id')
			->orderBy('last_name')->orderBy('first_name')
			->get();
		
		return $this->sendResponse($contact);
		// convert the collection to an array for use in returning the
		// desired response as JSON

		//$data = $contact->toArray();
		// send the response
		//return $this->sendResponse($data);
	}

	public function showPeople($id)//original api
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
	public function showPerson($id)
	{ //shows all contact info pertaining to one person
		//checking if id specified is email or member id.
		if(filter_var($id, FILTER_VALIDATE_EMAIL)){
			$person= Person::with('contacts')
				->where('email', $id)
				->get();
		}
		else{
			$person = Person::with('contacts')->where('individuals_id','members:'.$id)
				->get();
		}
		// convert the collection to an array for use in returning the
		// desired response as JSON
		$data = $person->toArray();
		
		// send the response
		return $this->sendResponse($data);

	}
	public function showDeptSpecificPerson($dept_id, $id)
	{
		//{dept_id}/members/{email}
		if(filter_var($id, FILTER_VALIDATE_EMAIL)){
			$contact = Contact::with('person')->where(function($query) use($dept_id, $id){
				$query->where('department','academic_departments:'.$dept_id)
					  ->where('email', $id);
			})->first();
		}
		else{
			$contact = Contact::with('person')->where(function($query) use($dept_id, $id){
				$query->where('department','academic_departments:'.$dept_id)
					  ->where('user_id', 'members:'.$id);
			})->first();
		}
		// convert the collection to an array for use in returning the
		// desired response as JSON
		//dd($contact);
		if(!empty($contact)){
			$data = $contact->toArray();
			return $this->sendResponse($data);
		}
		else
			echo 'The person with an id of '.$id.' does not exist in department '.$dept_id.'.';
		
		
		// send the response
		
	}
	


}
