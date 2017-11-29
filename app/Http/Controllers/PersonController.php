<?php namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use App\Models\NemoEntity;
use DB;
use App\Models\Person;
use App\Models\Individual;
use App\Models\Registry;
use Illuminate\Http\Request;

class PersonController extends Controller {

    
    /**
     * The string to prepend to id
     *
     * @var [string]
     */
    private $idPrependString;

    
    /**
     * Class Constructor to initialize any values we need.
     */
    public function __construct() {
        $this->idPrependString = env('LDAP_DB_USER_ID_PREFIX');
    }
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
		$person = Person::whereEmail($email)->with('contacts')->first();
		return $person;
    }
    
    /**
     * Check to see if the user exists in Registry
     *
     * @param [string] $email
     * @return [int]
     */
    private function checkUserInRegistry($email) {
        return count(Registry::whereEmail($email)->get());
    }

    /**
     * Generates the next affiliate id
     *
     * @return [int]
     */
    private function generateNextAffiliateId() {
        $latestId = Individual::where('individuals_id','LIKE','%affiliates:%')
                                ->where('individuals_id', 'NOT LIKE', '%'.'csuchancellor')
                                ->orderBy('individuals_id','DESC')->first();
        if (!count($latestId)) {
            $nextId = $this->idPrependString.'affiliates:1';
        } else {
            $latestId = $latestId['individuals_id'];
            $latestId = substr($latestId, 11);
            $latestId = substr($latestId, 0, strpos($latestId, ':'));
            $nextId = $latestId + 1;
            $nextId = $this->idPrependString.'affiliates:'.$nextId;
        }

        return ($nextId);
    }

    /**
     * Generates the user's POSIX UID
     *
     * @param [string] $first_name
     * @param [string] $last_name
     * @param [int] $user_id
     * @return [string]
     */
    private function generatePosixUid($first_name, $last_name, $user_id) {
        $posix_uid = strtolower(substr($first_name, 0, 1))
                    .strtolower(substr($last_name,0,1))
                    .trim($user_id, $this->idPrependString.'affiliates:')
                    .'a';
        return $posix_uid;
    }

    /**
     * Preforms the writes to the individuals table
     *
     * @param [array] $values
     * @return [boolean]
     */
    private function writeToIndividual($values) {
        $affiliate                  = new Individual();
        $affiliate->individuals_id  = $values['user_id'];
        $affiliate->first_name      = $values['first_name'];
        $affiliate->last_name       = $values['last_name'];
        $affiliate->common_name     = $values['common_name'];
        $affiliate->affiliation     = $values['affiliation'];
        $status = $affiliate->save();
        if($status)
            return true;

        return false;
    }

    /**
     * Preforms the writes to the registry table
     *
     * @param [array] $values
     * @return [boolean]
     */
    private function writeToRegistry($values) {
        $affiliate              = new Registry();
        $affiliate->uuid        = $values['uuid'];
        $affiliate->entities_id = $values['user_id'];
        $affiliate->posix_uid   = $values['posix_uid'];
        $affiliate->email       = $values['email'];
        $status = $affiliate->save();
        if($status)
            return true;

        return false;
    }

    /**
     * Performs the writes to the entity table
     *
     * @param array $values
     * @return [boolean]
     */
    private function writeToEntity($values) {
        $affiliate               = new NemoEntity();
        $affiliate->entities_id  = $values['user_id'];
        $affiliate->display_name = $values['common_name'];
        $status = $affiliate->save();
        if($status)
            return true;

        return false;
    }

    /**
     * Adds the affiliate to the database
     *
     * @param [Request] $request
     * @return [JSON]
     */
    public function addAffiliate(Request $request) {
        $this->validate($request, [
            'first_name' => 'required',
            'last_name'  => 'required',
            'email'      => 'required'
        ]);
        $email = $request->input('email');
        $count = $this->checkUserInRegistry($email);
        if ($count) {
            return [
                'message' => 'User with email '.$email.' already exists.'
            ];
        }
   
        $last_name   = $request->input('last_name');
        $first_name  = $request->input('first_name');
        $common_name = $first_name.' '.$last_name;
        $user_id     = $this->generateNextAffiliateId();
        $posix_uid   = $this->generatePosixUid($first_name, $last_name, $user_id);
        $uuid        = DB::raw('UUID()');

        $values = [
            'affiliation' => 'affiliate',
            'common_name' => $common_name,
            'email'       => $email,
            'first_name'  => $first_name,
            'last_name'   => $last_name,
            'posix_uid'   => $posix_uid,
            'user_id'     => $user_id,
            'uuid'        => $uuid
        ];

        if ($this->writeToRegistry($values)) {
            if ($this->writeToIndividual($values)) {
                if ($this->writeToEntity($values)) {
                    return [
                        'message' => 'User successfully added to database.',
                        'user'    => [
                            'user_id'   => $values['user_id'],
                            'email'     => $values['email'],
                            'posix_uid' => $values['posix_uid']
                        ]
                    ];
                }
            }
        }

        return [
            'message' => 'Oops, something went wrong.'
        ];
    }

    /**
     * Removes the affiliate from the databases
     *
     * @param [Request] $request
     * @return [JSON]
     */
    public function removeAffiliate(Request $request) {
        $this->validate($request, [
            'email' => 'required'
        ]);
        $email = $request->input('email');
        $count = $this->checkUserInRegistry($email);
        if (!$count) {
            return [
                'message' => 'User with email '.$email.' does not exist.'
            ];
        }

        // yes two calls but we need to get the user id from an email...
        $affiliate = Registry::whereEmail($email)->first();
        $user_id = $affiliate->entities_id;
        if (Registry::where('entities_id', $user_id)->delete()) {
            if (Individual::find($user_id)->delete()) {
                if (NemoEntity::find($user_id)->delete()) {
                    return [
                        'message' => 'User with email ' . $email . ' successfully deleted from database.'
                    ];
                }
            }
        }

        return [
            'message' => 'Oops, something went wrong.'
        ];

    }
}