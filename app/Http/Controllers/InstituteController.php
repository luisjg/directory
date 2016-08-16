<?php namespace App\Http\Controllers;

use App\Handlers\HandlerUtilities;

use App\Http\Controllers\Controller;
use Request;
use App\Models\Department;
use App\Models\AcademicDepartment;
use App\Models\Contact;
use App\Models\Person;
use App\Models\Institute;

class InstituteController extends Controller {

	/**
	 * Retrieves all the institutes available
	 * @return Response JSON response
	 */
	public function showAllInstitutes()
	{
		$institutes = Institute::where('connectable_id', 'LIKE', 'institutes:%')
			->get();
		$data = $institutes->toArray();
		return $this->sendResponse($data, "institutes");
	}

	/**
	 * Retrieves a specific institute
	 * @param  String $institute_id the institute short string
	 * @return Response JSON response
	 */
	public function showSpecificInstitute($institute_id)
	{
		$institute = Institute::where('connectable_id', 'institutes:'.$institute_id)
			->firstOrFail();
		$data = $institute->toArray();
		return $this->sendResponse($data, "institute");
	}

	/**
	 * Returns all the members in a given institute
	 * @param  String $institute_id the institute short string
	 * @return Response JSON response
	 */
	public function showMembers($institute_id)
	{
		$institute = Person::with('image')->where('confidential', 0)->whereHas('entityUser', function($q) use ($institute_id) {
			$q->where('parent_entities_id', 'institutes:'. $institute_id);
		})->get();
		$data = $institute->toArray();
		return $this->sendResponse($data, "people");
	}
}