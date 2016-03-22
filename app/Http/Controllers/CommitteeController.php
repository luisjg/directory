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
	// public function showMembers($committee_id) {
	// 	// grab the committee with its associated people (ordered by their names)
	// 	$committee = Committee::with(['people' => function($q) {
	// 		$q->orderBy('last_name')->orderBy('first_name');
	// 	}])->findOrFail("committees:$committee_id");

	// 	// convert the collection to an array for use in returning the
	// 	// desired response as JSON
	// 	$data = $committee->toArray();

	// 	// send the response back
	// 	return $this->sendResponse($data);
	// }
	// 
	public function showMembers($committee_id) {
		$people = Person::whereHas('entityUser', function($q) use ($committee_id) {
			$q->where('parent_entities_id', 'committees:'.$committee_id);
		})->with('entityUser', 'contacts', 'image')
		  ->orderBy('last_name', 'ASC')
		  ->get();
		 return $this->sendResponse($people);
	}

	public function showCommittees() {
		// /committees
		//shows all current committees
		$committee = Committee::where('entity_type',"Committee")->get();

 		// convert the collection to an array for use in returning the
		// desired response as JSON
		$data = $committee->toArray();

		// send the response back
		return $this->sendResponse($data);	
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
	public function showCommittee($committee_id){
		$committee = Committee::where('entities_id', 'committees:'.$committee_id)->get();
		$data = $committee->toArray();
		return $this->sendResponse($data);
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