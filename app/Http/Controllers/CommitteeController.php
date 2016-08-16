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
		$people = Person::with('contacts', 'image')
				->whereHas('entityUser', function($q) use ($committee_id) {
					$q->where('parent_entities_id', 'committees:'.$committee_id);
				})->get();

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
					->firstOrFail();
		return $this->sendResponse($committee, "committee");
	}

}