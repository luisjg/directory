<?php namespace App\Http\Controllers;

use App\Handlers\HandlerUtilities;

use App\Http\Controllers\Controller;

use App\Models\AdministrativeDepartment;
use App\Models\Contact;
use App\Models\Person;

class AdministrativeDepartmentController extends Controller {

	/**
	 * Returns a listing of all people in the specified committee.
	 *
	 * @param string $committee_id The short ID of the committee
	 * @return Response
	 */
	public function showPeople($dept_id) 
	{
		$persons = Person::with('contacts')->where('parent_entities_id', 'departments:'.$dept_id)
			->orderBy('last_name')->orderBy('first_name')
			->get();
		// convert the collection to an array for use in returning the
		// desired response as JSON
		$data = $persons->toArray();	
		// send the response
		return $this->sendResponse($data);
	}


	public function showAllAdministrativeDepartments()
	{
		$administrativeDept = AdministrativeDepartment::all();
		$data = $administrativeDept->toArray();
		return $this->sendResponse($data);
	}

	public function showDeptSpecificPerson($dept_id, $email)
	{
		//{dept_id}/members/{email}
		$contact = Contact::with('person')->where(function($query) use($dept_id, $email){
			$query->where('parent_entities_id','departments:'.$dept_id)
				  ->where('email', $email);
		})->first();
		// convert the collection to an array for use in returning the
		// desired response as JSON
		//dd($contact);
	
		$data = $contact->toArray();
		
		// send the response
		return $this->sendResponse($data);		
	}
	public function showPersonByID($member_id){
		$contact = Contact::with('person')
			->where('entities_id', 'members:'.$member_id)
			->where('parent_entities_id','like','%departments:%')
			->get();
		// convert the collection to an array for use in returning the
		// desired response as JSON
		
		$data = $contact->toArray();
		// send the response back
		return $this->sendResponse($data);
	}
}