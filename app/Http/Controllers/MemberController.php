<?php namespace App\Http\Controllers;

use App\Models\Person;
use Illuminate\Http\Request;

class MemberController extends Controller {

    /**
     * [showMemberById description]
     * @param Request $request
     * @param  [Integer] $individuals_id [individuals_id to be looked up into the database. Person model.]
     * @return Response [JSON]
     * individuals_id is the primary key on the faculty.person table
     * contact_id is the primary key on the faculty.contacts table
     * entities_id is the foreign key on the faculty.contacts table
     * Only returns attributes: first_name, last_name, telephone, website, location, email
     */
	private function showMemberById(Request $request, $individuals_id) {
	    $whereConstraints = [
	        'individuals_id' => 'members:'.$individuals_id
        ];
        // we check to see if we have to honor the FERPA flag
        // if no secret key exists then we do honor FERPA flag
        if (!($request->has('secret') && $request->get('secret') === config('app.app_secret'))) {
            $whereConstraints['confidential'] = 0;
        }
        $person = $this->personRetriever($whereConstraints, 'contacts');
		return $this->sendResponse($person);
	}

    /**
     * Query the members by email
     * @param Request $request
     * @param Request the HTTP POST request
     * @return Response the JSON response
     */
	public function showMemberByEmail(Request $request, $email) {

	    $whereConstraints = [
	        'email' => $email
        ];
	    // we check to see if we have to honor the FERPA flag
        // if no secret key exists then we do honor FERPA flag
        if (!($request->has('secret') && $request->get('secret') === config('app.app_secret'))) {
            $whereConstraints['confidential'] = 0;
        }
        $person = $this->personRetriever($whereConstraints, 'contacts');
		return $this->sendResponse($person);
	}

	/**
	 * Query the members by email with degree information
	 * @param Request the HTTP POST request
	 * @return JSON the JSON response
	 */
	public function showMemberByEmailWithDegrees($email) {
	    $whereConstraints = [
	        'email' => $email,
            'confidential' => 0
        ];
	    $withConstraints = [
	        'contacts',
            'degrees'
        ];
	    $person = $this->personRetriever($whereConstraints, $withConstraints);
		return $this->sendResponse($person);
	}

	/**
	 * Handles the showing of members
	 * @param  Request the HTTP POST request
	 * @return Response
	 */
	public function showMember(Request $request)
	{
		if($request->has('email')) {
		    $email = $request->get('email');
            $whereConstraints = [
                'email' => $email
            ];
            // we check to see if we have to honor the FERPA flag
            // if no secret key exists then we do honor FERPA flag
            if (!($request->has('secret') && $request->get('secret') === config('app.app_secret'))) {
                $whereConstraints['confidential'] = 0;
            }
            $person = $this->personRetriever($whereConstraints, 'contacts');

            if ($person->affiliation !== 'affiliate' && $person->affiliation !== 'student') {
                return $this->sendResponse($person);
            }
            return $this->sendResponse('error');
		} else if ($request->has('members_id')) {
			return $this->showMemberById($request['members_id']);
		} else {
			return $this->sendResponse('error');
		}
	}

    /**
     * Performs the retrieval from the database
     * @param $whereConstraints
     * @param $withConstraints
     * @return mixed
     */
	private function personRetriever($whereConstraints, $withConstraints)
    {
        return Person::where($whereConstraints)->with($withConstraints)->firstOrFail();
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
