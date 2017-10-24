<?php namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use App\Models\Person;
use App\Models\Individual;
use Illuminate\Http\Request;

class PersonController extends Controller {
	/**
	 * [showPersonByMemberID description]
	 * @param  [Integer] $individuals_id [individuals_id to be looked up into the database. Person model.]
	 * @return [JSON] 
	 * individuals_id is the primary key on the faculty.person table
	 * contact_id is the primary key on the faculty.contacts table
	 * entities_id is the foreign key on the faculty.contacts table 
	 * Only returns attributes: first_name, last_name, telephone, website, location, email
	 */
	public function showPersonByMemberID($individuals_id) {
		$person = Person::where('individuals_id', 'members:'.$individuals_id)
		//Must specify individuals_id
			->select('individuals_id','first_name','last_name')
			->with(['contacts' => function($q){
				//Must specificy contact_id and entities_id
				$q->select('contact_id','entities_id','telephone', 'website', 'location', 'email')->first();
			}])
			->first();
		return $this->sendResponse($person);
	}
	
	/**
	 * [showPersonByEmail description]
	 * @param  [String] $email [email to be looked up in the database. Person model.]
	 * @return [JSON]        
	 */
	public function showPersonByEmail($email) {
		$person = Person::where('email', $email)->with('contacts')->first();
		return $person;
	}

	public function updateFirstLastNameById(Request $request){
      Individual::where('individuals_id','LIKE','%'. $request->input('id') .'%')
                ->update([
                    'first_name' => $request->input('first'),
                    'last_name'  => $request->input('last')
                    ]);
    }
}