<?php namespace App\Http\Controllers;

use App\Handlers\HandlerUtilities;

use App\Http\Controllers\Controller;
use App\Models\Person;
use App\Models\Committee;
use App\Models\Contact;

class CommitteeController extends Controller {

	/**
	 * Returns a listing of all people in the specified committee.
	 *
	 * @param string $committee_id The short ID of the committee
	 * @return Response
	 */	
	public function showMembers($committee_id) {
		$committee = Committee::with(['people' => function($q) {
			$q->orderBy('last_name', 'DESC');
		}])->findOrFail('committees:'.$committee_id);

		return $this->sendResponse($committee);
	}

	
	public function showCommittees() {
		$committees = Committee::where('parent_entities_id', 'LIKE', 'committees:%')->get();
		return $this->sendResponse($committees);
	}

	/**
	 * Retrieves the committee members of a committee with their role
	 * and contact information
	 * @param  string $committee_id the committee short string
	 * @return Response
	 */
	// public function showCommitteeMemberRolesWithContact($committee_id){
	// 	$contacts = Contact::with('person')->where('parent_entities_id','committees:'.$committee_id)
	// 		->get();
	// 	// convert the collection to an array for use in returning the
	// 	// desired response as JSON
	// 	$data = $contacts->toArray();
	// 	// send the response back
	// 	return $this->sendResponse($data);
	// }

	/**
	 * Returns specific inromation about a given committee
	 * @param  string $committee_id the committee short string
	 * @return Response
	 */
	public function showCommittee($committee_id) {
		$committee = Committee::where('parent_entities_id', 'committees:'.$committee_id)
					->first();
		return $this->sendResponse($committee);
	}

	// public function showCommitteesByMemberId($member_id){
	// 	$committees = Contact::with('person')
	// 		->where('entities_id', 'members:'.$member_id)
	// 		->where('parent_entities_id','like','%committees:%')
	// 		->get();
	// 	//dd($committees);
	// 	// convert the collection to an array for use in returning the
	// 	// desired response as JSON
	// 	$data = $committees->toArray();
	// 	// send the response back
	// 	return $this->sendResponse($data);
	// }
	public function showCommitteesByMemberId($member_id) {
		$person = Person::whereHas('entityUser', function($q) use ($member_id) {
			$q->where('user_id', 'members:'.$member_id);
		})->with('entityUser', 'contacts', 'image')
		  ->first();
		 return $this->sendResponse($person);
	}
}