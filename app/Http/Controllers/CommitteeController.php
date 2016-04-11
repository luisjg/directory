<?php namespace App\Http\Controllers;

use App\Handlers\HandlerUtilities;

use App\Http\Controllers\Controller;
use App\Models\Person;
use App\Models\Committee;
use App\Models\Contact;

class CommitteeController extends Controller {

	/**
	 * Returns a listing of all people in the specified committee.
	 * @param string $committee_id The short ID of the committee
	 * @return Response JSON response
	 */	
	public function showMembers($committee_id) {
		$people = Person::whereHas('entityUser', function($q) use ($committee_id) {
			$q->where('parent_entities_id', 'committees:'.$committee_id);
		})->with('contacts')
		->get();

		$data = $people->toArray();
		return $this->sendResponse($data, "people");
	}

	/**
	 * Retrieves all the committees available
	 * @return Response JSON response
	 */
	public function showCommittees() {
		$committees = Committee::where('connectable_id', 'LIKE', 'committees:%')->get();
		return $this->sendResponse($committees, "committees");
	}

	/**
	 * Returns specific inrormation about a given committee
	 * @param  String $committee_id the committee short string
	 * @return Response JSON response
	 */
	public function showCommittee($committee_id) {
		$committee = Committee::where('connectable_id', 'committees:'.$committee_id)
					->first();
		return $this->sendResponse($committee, "committee");
	}

	/**
	 * Retrieves the committee information that a person belongs to
	 * @param  String $member_id the person id
	 * @return Response JSON response
	 */
	public function showCommitteesByMemberId($member_id) {
		$person = Person::whereHas('entityUser', function($q) use ($member_id) {
			$q->where('user_id', 'members:'.$member_id);
		})->with('entityUser', 'contacts', 'image')
		  ->first();
		 return $this->sendResponse($person, "people");
	}
}