<?php namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use App\Models\Person;
use Illuminate\Http\Request;

class MemberController extends Controller {
	/**
	 * [showMemberById description]
	 * @param  [Integer] $individuals_id [individuals_id to be looked up into the database. Person model.]
	 * @return [JSON] 
	 * individuals_id is the primary key on the faculty.person table
	 * contact_id is the primary key on the faculty.contacts table
	 * entities_id is the foreign key on the faculty.contacts table 
	 * Only returns attributes: first_name, last_name, telephone, website, location, email
	 */
	private function showMemberById($individuals_id) {
		$person = Person::where('confidential', 0)->where('individuals_id', 'members:'.$individuals_id)->with('contacts', 'image')->firstOrFail();
		return $this->sendResponse($person);
	}
	
	/**
	 * Query the members by email
	 * @param Request the HTTP POST request
	 * @return JSON the JSON response        
	 */
	private function showMemberByEmail($email) {
		if(env('APP_ENV') === 'local') {
			$person = Person::where('confidential', 0)->where('email', 'nr_'.$email)->with('contacts', 'image')->firstOrFail();
		} else {
			$person = Person::where('confidential', 0)->where('email', $email)->with('contacts', 'image')->firstOrFail();
		}
		return $this->sendResponse($person);
	}

	/**
	 * Handles the showing of members
	 * @param  Request the HTTP POST request
	 * @return JSON the JSON response
	 */
	public function showMember(Request $request)
	{
		if($request->has('email')) {
			return $this->showMemberByEmail($request['email']);
		} else {
			return $this->sendResponse('error');
		}
	}

}