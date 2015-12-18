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


	public function showAdministrativeDepartments()
	{
		$administrativeDept = AdministrativeDepartment::all();
		$data = $administrativeDept->toArray();
		return $this->sendResponse($data);
	}

	public function showDeptSpecificPerson($dept_id, $id)
	{
		if(filter_var($id, FILTER_VALIDATE_EMAIL)){
		//{dept_id}/members/{email}
			$person = Person::with('contacts')->where(function($query) use($dept_id, $id){
				$query->where('parent_entities_id','departments:'.$dept_id)
					  ->where('email', $id);
			})->first();
		}
		else{
			$person = Person::with('contacts')->where(function($query) use($dept_id, $id){
				$query->where('parent_entities_id','departments:'.$dept_id)
					  ->where('individuals_id','members:'.$id);
			})->first();
		}
		
		//dd($contact);
		if(!empty($person)){
			// convert the collection to an array for use in returning the
			// desired response as JSON
			$data = $person->toArray();
			return $this->sendResponse($data);
		}
		else
			echo 'The person with an id of '.$id.' does not exist in department '.$dept_id.'.';
		
		
	}
	

}