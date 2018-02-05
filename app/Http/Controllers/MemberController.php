<?php namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use App\Models\Person;
use App\Models\Degree;
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
	public function showMemberByEmail($email) {
		if(env('APP_ENV') === 'local') {
			$person = Person::where('confidential', 0)->where('email', 'nr_'.$email)->with('contacts')->firstOrFail();
		} else {
			$person = Person::where('confidential', 0)->where('email', $email)->with('contacts')->firstOrFail();
		}
		return $this->sendResponse($person);
	}

	/**
	 * Query the members by email with degree information
	 * @param Request the HTTP POST request
	 * @return JSON the JSON response        
	 */
	public function showMemberByEmailWithDegrees($email) {
		if(env('APP_ENV') === 'local') {
			$person = Person::where('confidential', 0)->where('email', 'nr_'.$email)->with('contacts', 'degrees')->firstOrFail();
		} else {
			$person = Person::where('confidential', 0)->where('email', $email)->with('contacts', 'degrees')->firstOrFail();
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
			if(env('APP_ENV') === 'local') {
				$person = Person::where('confidential', 0)->where('email', 'nr_'.$request['email'])->with('contacts')->firstOrFail();
				return $this->sendResponse($person);
			} else {
				$person = Person::where('confidential', 0)->where('email', $request['email'])->with('contacts')->firstOrFail();
				return $this->sendResponse($person);
			}
		} else if ($request->has('members_id')) {
			return $this->showMemberById($request['members_id']);
		} else {
			return $this->sendResponse('error');
		}
	}

	/**
	 * Handles the showing of CSUN Faculty of specific type (all Faculty if type is not specified)
	 * @param  Request the HTTP POST request, type of faculty requested (if any)
	 * @return JSON the JSON response
	 */
	public function showAllFaculty(Request $request, $type=null)
	{
	    if ($type == null && $type == 'all') {
	        //All faculty or nothing specific requested
            $people = Person::where('affiliation', 'faculty')
                ->whereNotIn('rank', ['Chancellor'])
                ->orderBy('last_name')
                ->orderBy('first_name')
                ->get();
        } else if ($type == "tenure-track") {
	        //Active tenured/tenure-track faculty requested
            $people = Person::where('affiliation','faculty')
                ->whereNotIn('rank', ['Lecturer', 'Chancellor'])
                ->orderBy('last_name')
                ->orderBy('first_name')
                ->get();
        } else if ($type == "emeriti") {
	        //Emeriti requested
            $people = Person::where('affiliation','emeritus')
                ->whereNotIn('rank', ['Lecturer', 'Chancellor'])
                ->orderBy('last_name')
                ->orderBy('first_name')
                ->get();
        } else if ($type == 'lecturer') {
	        //Lecturers requested
            $people = Person::where('affiliation','faculty')
                ->whereIn('rank', ['Lecturer'])
                ->orderBy('last_name')
                ->orderBy('first_name')
                ->get();
        } else {
	        //Invalid subset requested
            $people = collect();
        }

		return $this->sendResponse($people);
	}

	/**
	 * Handles the showing of all CSUN Tenure-Track Faculty (non-lecturer, non-emeriti)
	 * @param  Request the HTTP POST request
	 * @return JSON the JSON response
	 */
	public function showAllTenureTracks(Request $request)
	{
		$people = Person::where('affiliation','faculty')
			->whereNotIn('rank', ['Lecturer', 'Chancellor'])
			->orderBy('last_name')
			->orderBy('first_name')
			->get();

		return $this->sendResponse($people);
	}

	/**
	 * Handles the showing of all CSUN Faculty Emeriti (non-lecturer)
	 * @param  Request the HTTP POST request
	 * @return JSON the JSON response
	 */
	public function showAllEmeriti(Request $request)
	{
		$people = Person::where('affiliation','emeritus')
			->whereNotIn('rank', ['Lecturer', 'Chancellor'])
			->orderBy('last_name')
			->orderBy('first_name')
			->get();

		return $this->sendResponse($people);
	}

	/**
	 * Handles the showing of all CSUN Lecturers
	 * @param  Request the HTTP POST request
	 * @return JSON the JSON response
	 */
	public function showAllLecturers(Request $request)
	{
		$people = Person::where('affiliation','faculty')
			->whereIn('rank', ['Lecturer'])
			->orderBy('last_name')
			->orderBy('first_name')
			->get();

		return $this->sendResponse($people);

	}

}