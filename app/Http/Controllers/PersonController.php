<?php namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use DB;
use App\Models\Person;
use App\Models\Individual;
use App\Models\Registry;
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

	public function generateNextAffiliateId(){
        $latestId = Individual::where('individuals_id','LIKE','affiliates:'.'%')
                                ->where('individuals_id', 'NOT LIKE', '%'.'csuchancellor')
                                ->orderBy('individuals_id','DESC')->first();
        if (!count($latestId)) {
            $nextId='affiliates:1:a';
        }
        else {
            $latestId = $latestId['individuals_id'];
            $latestId = substr($latestId, 11);
            $latestId = substr($latestId, 0, strpos($latestId, ':'));
            $nextId = $latestId + 1;
            $nextId = 'affiliates:' . $nextId . ':a';
        }
        return ($nextId);

    }

    public function addAffiliate(Request $request){
        $this->validate($request, [
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required'
        ]);
        $email = $request->input('email');
        if(count(Registry::where('email',$email)->get()))
            return ['message'=>"Affiliate Already Exists"];
        $id = $this->generateNextAffiliateId();
        $first = $request->input('first_name');
        $last = $request->input('last_name');
        $common_name = $first . ' ' . $last;
        $uuid = DB::raw('UUID()');
        $posix_uid = substr($email, 0, strpos($email, "@"));
        $affiliate = new Individual();
        $affiliate->first_name = $first;
        $affiliate->last_name = $last;
        $affiliate->common_name = $common_name;
        $affiliate->individuals_id = $id;
        $affiliate->confidential = 0;
        $affiliate->deceased = 0;
        $affiliate->affiliation_status = 'Active';
        $affiliate->affiliation = 'affiliate';
        $affiliate->save();
        $affiliate = new Registry();
        $affiliate->email = $email;
        $affiliate->posix_uid = $posix_uid;
        $affiliate->entities_id = $id;
        $affiliate->uuid = $uuid;
        $affiliate->save();
        return [
            'message' => 'Affiliate Successfully Added to Database',
            'user' => ['id'=>$id, 'email'=> $email]
        ];
    }
}