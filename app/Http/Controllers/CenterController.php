<?php

namespace App\Http\Controllers;

use App\Handlers\HandlerUtilities;
use App\Http\Controllers\Controller;
use Request;
use App\Models\Department;
use App\Models\AcademicDepartment;
use App\Models\Contact;
use App\Models\Person;
use App\Models\Center;

class CenterController extends Controller {

	/**
	 * Retrieves all the centers available
	 * @return Response JSON response
	 */
	public function showAllCenters()
	{
		$centers = Center::where('connectable_id', 'LIKE', 'centers:%')->get();
		$data = $centers->toArray();
		return $this->sendResponse($data, "centers");
	}



	/**
	 * Retrieves a specific center by id
	 * @param  String $center_id the center short string
	 * @return Response JSON response
	 */
	public function showSpecificCenter($center_id) {
		$centers = Center::where('connectable_id', 'LIKE', 'centers:'.$center_id)->firstOrFail();
		$data = $centers->toArray();
		return $this->sendResponse($data, "center");
	}


	/**
	 * Retrieves all the members in a center
	 * @param  String $center_id the center short string
	 * @return Response JSON response
	 */
	public function showMembers($center_id)
	{
		$people = Person::with('contacts')
				->whereHas('entityUser', function($q) use ($center_id) {
					$q->where('parent_entities_id', 'centers:'.$center_id);
					$q->where('confidential', 0);
				})->get();

		$data = $people->toArray();
		return $this->sendResponse($data, "people");
	}
}