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
        $person = Person::where('confidential', 0)->where('email', $email)->with('contacts')->firstOrFail();
		return $this->sendResponse($person);
	}

	/**
	 * Query the members by email with degree information
	 * @param Request the HTTP POST request
	 * @return JSON the JSON response        
	 */
	public function showMemberByEmailWithDegrees($email) {
        $person = Person::where('confidential', 0)->where('email', $email)->with('contacts', 'degrees')->firstOrFail();
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
            $person = Person::where('confidential', 0)->where('email', $request['email'])->with('contacts')->firstOrFail();
            return $this->sendResponse($person);
		} else if ($request->has('members_id')) {
			return $this->showMemberById($request['members_id']);
		} else {
			return $this->sendResponse('error');
		}
	}

	/**
	 * Handles the showing of CSUN faculty by type with given first letter of last name
	 * @param  Request the HTTP POST request, type of faculty requested (if any), first letter(s) of last name (if any)
	 * @return JSON the JSON response
	 */
	public function showAllFaculty(Request $request, $type, $letter=null)
	{
        if ($type == 'all') {
            //All faculty requested
            $people = Person::when($letter, function($query) use ($letter) {
                    $query->where('last_name', 'LIKE', $letter.'%');
                })
                ->where('affiliation', 'faculty')
                ->whereNotIn('rank', ['Chancellor'])
                ->orderBy('last_name')
                ->orderBy('first_name')
                ->get();
        } else if ($type == "tenure-track") {
            //Active tenured/tenure-track faculty requested
            $people = Person::when($letter, function($query) use ($letter) {
                    $query->where('last_name', 'LIKE', $letter.'%');
                })
                ->where('affiliation', 'faculty')
                ->whereNotIn('rank', ['Lecturer', 'Chancellor'])
                ->orderBy('last_name')
                ->orderBy('first_name')
                ->get();
        } else if ($type == "emeriti") {
            //Emeriti requested
            $people = Person::when($letter, function($query) use ($letter) {
                    $query->where('last_name', 'LIKE', $letter.'%');
                })
                ->where('affiliation', 'emeritus')
                ->whereNotIn('rank', ['Lecturer', 'Chancellor'])
                ->orderBy('last_name')
                ->orderBy('first_name')
                ->get();
        } else if ($type == 'lecturer') {
            //Lecturers requested
            $people = Person::when($letter, function($query) use ($letter) {
                    $query->where('last_name', 'LIKE', $letter.'%');
                })
                ->where('affiliation', 'faculty')
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
     * Handles the showing of CSUN faculty by type with degree information with given first letter of last name
     * @param  Request the HTTP POST request, type of faculty requested (if any), first letter(s) of last name (if any)
     * @return JSON the JSON response
     */
    public function showAllFacultyWithDegrees(Request $request, $type, $letter=null)
    {
        if ($type == 'all') {
            //All faculty requested
            $people = Person::when($letter, function($query) use ($letter) {
                $query->where('last_name', 'LIKE', $letter.'%');
            })
                ->where('affiliation', 'faculty')
                ->whereNotIn('rank', ['Chancellor'])
                ->with('degrees')
                ->orderBy('last_name')
                ->orderBy('first_name')
                ->get();
        } else if ($type == "tenure-track") {
            //Active tenured/tenure-track faculty requested
            $people = Person::when($letter, function($query) use ($letter) {
                $query->where('last_name', 'LIKE', $letter.'%');
            })
                ->where('affiliation', 'faculty')
                ->whereNotIn('rank', ['Lecturer', 'Chancellor'])
                ->with('degrees')
                ->orderBy('last_name')
                ->orderBy('first_name')
                ->get();
        } else if ($type == "emeriti") {
            //Emeriti requested
            $people = Person::when($letter, function($query) use ($letter) {
                $query->where('last_name', 'LIKE', $letter.'%');
            })
                ->where('affiliation', 'emeritus')
                ->whereNotIn('rank', ['Lecturer', 'Chancellor'])
                ->with('degrees')
                ->orderBy('last_name')
                ->orderBy('first_name')
                ->get();
        } else if ($type == 'lecturer') {
            //Lecturers requested
            $people = Person::when($letter, function($query) use ($letter) {
                $query->where('last_name', 'LIKE', $letter.'%');
            })
                ->where('affiliation', 'faculty')
                ->whereIn('rank', ['Lecturer'])
                ->with('degrees')
                ->orderBy('last_name')
                ->orderBy('first_name')
                ->get();
        } else {
            //Invalid subset requested
            $people = collect();
        }
        return $this->sendResponse($people);
    }

}